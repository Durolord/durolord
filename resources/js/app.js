import './bootstrap';

/**
 * Duro UI runtime.
 *
 * Alpine is provided by Livewire, so we only register stores, data
 * components and directives once Alpine boots.
 */
const duroThemes = () => window.__duro?.themes ?? {};

const duroFamilies = () => window.__duro?.families ?? {};

const systemMode = () => (window.matchMedia('(prefers-color-scheme: light)').matches ? 'light' : 'dark');

const storage = {
    get(key) {
        try {
            return localStorage.getItem(key);
        } catch (e) {
            return null;
        }
    },
    set(key, value) {
        try {
            localStorage.setItem(key, value);
        } catch (e) {
            // Storage can be unavailable (private mode); the theme still applies for this page.
        }
    },
};

const applyThemeToDocument = (id) => {
    const theme = duroThemes()[id] ?? {};
    const root = document.documentElement;
    const isDark = theme.mode !== 'light';

    root.dataset.theme = id;
    root.dataset.family = theme.family;
    root.classList.toggle('dark', isDark);
    root.style.colorScheme = isDark ? 'dark' : 'light';

    const meta = document.querySelector('meta[name="theme-color"]');

    if (meta && theme.swatches) {
        meta.setAttribute('content', theme.swatches[0]);
    }
};

const prefersReducedMotion = () => window.matchMedia('(prefers-reduced-motion: reduce)').matches;

const revealObserver = 'IntersectionObserver' in window
    ? new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-revealed');
                revealObserver.unobserve(entry.target);
            }
        });
    }, { rootMargin: '0px 0px -8% 0px', threshold: 0.08 })
    : null;

const observeReveals = () => {
    document.querySelectorAll('[data-reveal]:not(.is-revealed)').forEach((el) => {
        if (! revealObserver) {
            el.classList.add('is-revealed');

            return;
        }

        revealObserver.observe(el);
    });
};

document.addEventListener('DOMContentLoaded', observeReveals);
document.addEventListener('livewire:navigated', observeReveals);

document.addEventListener('alpine:init', () => {
    // ========== THEME STORE ==========
    Alpine.store('theme', {
        family: document.documentElement.dataset.family,
        mode: ['light', 'dark', 'system'].includes(storage.get('duro-mode')) ? storage.get('duro-mode') : 'system',
        current: document.documentElement.dataset.theme,

        init() {
            window.matchMedia('(prefers-color-scheme: light)').addEventListener('change', () => {
                if (this.mode === 'system') {
                    this.apply();
                }
            });
        },

        get all() {
            return duroThemes();
        },

        get families() {
            return duroFamilies();
        },

        get meta() {
            return duroThemes()[this.current] ?? {};
        },

        get familyMeta() {
            return duroFamilies()[this.family] ?? {};
        },

        get resolvedMode() {
            return this.mode === 'system' ? systemMode() : this.mode;
        },

        get isDark() {
            return this.meta.mode !== 'light';
        },

        apply(event = null) {
            const family = duroFamilies()[this.family] ? this.family : (window.__duro?.defaultFamily ?? 'runic');
            const id = duroFamilies()[family][this.resolvedMode];

            storage.set('duro-family', family);
            storage.set('duro-mode', this.mode);

            if (id === this.current) {
                return;
            }

            const commit = () => {
                this.family = family;
                this.current = id;
                applyThemeToDocument(id);
                window.dispatchEvent(new CustomEvent('duro-theme-changed', { detail: { theme: id, family, mode: this.mode } }));
            };

            if (! document.startViewTransition || prefersReducedMotion()) {
                commit();

                return;
            }

            const x = event?.clientX ?? window.innerWidth / 2;
            const y = event?.clientY ?? 0;
            const radius = Math.hypot(Math.max(x, window.innerWidth - x), Math.max(y, window.innerHeight - y));

            document.startViewTransition(commit).ready.then(() => {
                document.documentElement.animate(
                    { clipPath: [`circle(0px at ${x}px ${y}px)`, `circle(${radius}px at ${x}px ${y}px)`] },
                    { duration: 650, easing: 'cubic-bezier(0.22, 1, 0.36, 1)', pseudoElement: '::view-transition-new(root)' },
                );
            });
        },

        // Select an exact theme: adopts its family and mode.
        set(id, event = null) {
            const theme = duroThemes()[id];

            if (! theme) {
                return;
            }

            this.family = theme.family;
            this.mode = theme.mode;
            this.apply(event);
        },

        setFamily(family, event = null) {
            if (! duroFamilies()[family]) {
                return;
            }

            this.family = family;
            this.apply(event);
        },

        setMode(mode, event = null) {
            this.mode = mode;
            this.apply(event);
        },

        toggleMode(event = null) {
            this.setMode(this.resolvedMode === 'dark' ? 'light' : 'dark', event);
        },

        next(event = null) {
            const ids = Object.keys(duroFamilies());

            this.setFamily(ids[(ids.indexOf(this.family) + 1) % ids.length], event);
        },
    });

    // ========== TOASTS ==========
    Alpine.store('toasts', {
        items: [],
        counter: 0,

        push({ title = '', body = '', variant = 'info', timeout = 4500 } = {}) {
            const id = ++this.counter;

            this.items.push({ id, title, body, variant });

            if (timeout) {
                setTimeout(() => this.dismiss(id), timeout);
            }
        },

        dismiss(id) {
            this.items = this.items.filter((item) => item.id !== id);
        },
    });

    window.duroToast = (payload) => Alpine.store('toasts').push(payload);

    window.addEventListener('duro-toast', (event) => {
        const detail = Array.isArray(event.detail) ? event.detail[0] : event.detail;

        Alpine.store('toasts').push(detail ?? {});
    });

    // ========== LAYOUT STATE (sidebar, mobile nav, command palette) ==========
    Alpine.data('layoutState', () => ({
        sidebarCollapsed: false,
        mobileNav: false,
        palette: false,
        scrolled: false,

        init() {
            try {
                this.sidebarCollapsed = localStorage.getItem('duro-sidebar') === 'collapsed';
            } catch (e) {
                this.sidebarCollapsed = false;
            }

            const onScroll = () => {
                this.scrolled = window.scrollY > 12;
            };

            onScroll();
            window.addEventListener('scroll', onScroll, { passive: true });

            window.addEventListener('keydown', (event) => {
                if ((event.metaKey || event.ctrlKey) && event.key.toLowerCase() === 'k') {
                    event.preventDefault();
                    this.palette = ! this.palette;
                }
            });
        },

        get theme() {
            return Alpine.store('theme').current;
        },

        cycleTheme(event = null) {
            Alpine.store('theme').next(event);
        },

        setTheme(id, event = null) {
            Alpine.store('theme').set(id, event);
        },

        toggleSidebar() {
            this.sidebarCollapsed = ! this.sidebarCollapsed;

            try {
                localStorage.setItem('duro-sidebar', this.sidebarCollapsed ? 'collapsed' : 'expanded');
            } catch (e) {
                // Ignore unavailable storage.
            }
        },
    }));

    // ========== COMMAND PALETTE ==========
    Alpine.data('commandPalette', (commands = []) => ({
        query: '',
        active: 0,
        commands,

        get results() {
            const q = this.query.trim().toLowerCase();

            if (! q) {
                return this.commands;
            }

            return this.commands.filter((command) => `${command.label} ${command.group} ${command.keywords ?? ''}`.toLowerCase().includes(q));
        },

        move(step) {
            const total = this.results.length;

            if (! total) {
                return;
            }

            this.active = (this.active + step + total) % total;
            this.$nextTick(() => this.$refs.list?.querySelector('[data-active="true"]')?.scrollIntoView({ block: 'nearest' }));
        },

        run(command, event = null) {
            if (! command) {
                return;
            }

            if (command.action === 'toggle-mode') {
                Alpine.store('theme').toggleMode(event);
            } else if (command.theme) {
                Alpine.store('theme').set(command.theme, event);
            } else if (command.href) {
                window.location.href = command.href;
            }

            this.query = '';
            this.active = 0;
            this.$dispatch('close-palette');
        },
    }));

    // ========== COUNT-UP NUMBERS ==========
    Alpine.data('countUp', (target = 0, duration = 1400) => ({
        value: 0,

        start() {
            if (prefersReducedMotion()) {
                this.value = target;

                return;
            }

            const started = performance.now();
            const tick = (now) => {
                const progress = Math.min((now - started) / duration, 1);
                const eased = 1 - Math.pow(1 - progress, 3);

                this.value = Math.round(target * eased);

                if (progress < 1) {
                    requestAnimationFrame(tick);
                }
            };

            requestAnimationFrame(tick);
        },
    }));

    // ========== TOOLTIP DIRECTIVE (x-tooltip, x-tooltip.top, .left, .right) ==========
    Alpine.directive('tooltip', (el, { expression, modifiers }, { evaluate, cleanup }) => {
        let tooltip = null;
        let hideTimeout = null;

        const placement = ['top', 'left', 'right'].find((side) => modifiers.includes(side)) ?? 'bottom';

        const remove = () => {
            clearTimeout(hideTimeout);
            tooltip?.remove();
            tooltip = null;
        };

        const hide = () => {
            if (! tooltip) {
                return;
            }

            tooltip.style.opacity = '0';
            hideTimeout = setTimeout(remove, 150);
        };

        const show = () => {
            remove();

            let message = '';

            try {
                message = expression ? evaluate(expression) : '';
            } catch (e) {
                message = expression;
            }

            if (! message) {
                return;
            }

            tooltip = document.createElement('div');
            tooltip.className = 'duro-tooltip';
            tooltip.setAttribute('role', 'tooltip');
            tooltip.textContent = message;
            tooltip.style.opacity = '0';
            document.body.appendChild(tooltip);

            const rect = el.getBoundingClientRect();
            const gap = 8;
            const positions = {
                top: [rect.left + rect.width / 2, rect.top - gap, 'translate(-50%, -100%)'],
                bottom: [rect.left + rect.width / 2, rect.bottom + gap, 'translate(-50%, 0)'],
                left: [rect.left - gap, rect.top + rect.height / 2, 'translate(-100%, -50%)'],
                right: [rect.right + gap, rect.top + rect.height / 2, 'translate(0, -50%)'],
            };
            const [left, top, transform] = positions[placement];

            tooltip.style.left = `${left}px`;
            tooltip.style.top = `${top}px`;
            tooltip.style.transform = `${transform} scale(0.96)`;

            requestAnimationFrame(() => {
                if (! tooltip) {
                    return;
                }

                tooltip.style.opacity = '1';
                tooltip.style.transform = `${transform} scale(1)`;
            });
        };

        el.addEventListener('mouseenter', show);
        el.addEventListener('mouseleave', hide);
        el.addEventListener('focus', show);
        el.addEventListener('blur', hide);
        el.addEventListener('click', hide);

        cleanup(() => {
            remove();
            el.removeEventListener('mouseenter', show);
            el.removeEventListener('mouseleave', hide);
            el.removeEventListener('focus', show);
            el.removeEventListener('blur', hide);
            el.removeEventListener('click', hide);
        });
    });

    // ========== COPY TO CLIPBOARD (x-copy="text") ==========
    Alpine.directive('copy', (el, { expression }, { evaluate }) => {
        el.addEventListener('click', async () => {
            const text = evaluate(expression);

            try {
                await navigator.clipboard.writeText(text);
                window.duroToast({ title: 'Copied to clipboard', variant: 'success', timeout: 2000 });
            } catch (e) {
                window.duroToast({ title: 'Copy failed', body: 'Your browser blocked clipboard access.', variant: 'danger' });
            }
        });
    });

        // ========== SIMPLE MARKDOWN RENDERER ==========
    window.duroMarkdown = function (src) {
        if (!src || !src.trim()) {
            return '<p class="text-[11px] text-ink-subtle">Nothing to preview yet.</p>';
        }

        // Basic escaping
        let html = src
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;');

        // Headings
        html = html
            .replace(/^###### (.*$)/gim, '<h6>$1</h6>')
            .replace(/^##### (.*$)/gim, '<h5>$1</h5>')
            .replace(/^#### (.*$)/gim, '<h4>$1</h4>')
            .replace(/^### (.*$)/gim, '<h3>$1</h3>')
            .replace(/^## (.*$)/gim, '<h2>$1</h2>')
            .replace(/^# (.*$)/gim, '<h1>$1</h1>');

        // Bold, italic, inline code
        html = html
            .replace(/\*\*(.*?)\*\*/gim, '<strong>$1</strong>')
            .replace(/\*(.*?)\*/gim, '<em>$1</em>')
            .replace(/`([^`]+)`/gim, '<code>$1</code>');

        // Links
        html = html.replace(
            /\[(.*?)\]\((.*?)\)/gim,
            '<a href="$2" class="duro-link">$1</a>'
        );

        // Paragraphs & line breaks
        html = html
            .split(/\n{2,}/)
            .map(p => `<p>${p.replace(/\n/g, '<br />')}</p>`)
            .join('');

        return html;
    };

    // ========== ALPINE DATA: MARKDOWN EDITOR ==========
    Alpine.data('markdownEditor', (initial = '') => ({
        tab: 'write',
        raw: initial || '',
        get html() {
            return window.duroMarkdown(this.raw);
        }
    }));

        // ========== DURO RICH EDITOR ==========
    Alpine.data('duroRichEditor', (initial = '') => ({
        tab: 'write',
        raw: initial || '',

        // Auto-resize textarea
        resize() {
            const el = this.$refs.input;
            if (!el) return;
            el.style.height = 'auto';
            el.style.height = `${el.scrollHeight}px`;
        },

        // Basic formatting (not markdown — rich formatting!)
        get html() {
            let out = this.raw;

            // Bold: **text**
            out = out.replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>');

            // Italic: *text*
            out = out.replace(/\*(.*?)\*/g, '<em>$1</em>');

            // Underline: __text__
            out = out.replace(/__(.*?)__/g, '<u>$1</u>');

            // Line breaks
            out = out.replace(/\n/g, '<br>');

            return out.trim()
                ? out
                : '<p class="text-[11px] opacity-60">Nothing to preview yet.</p>';
        },

        init() {
            this.resize();
        }
    }));

        // ========== DURO TIPTAP-STYLE EDITOR ==========
    Alpine.data('duroTipTapLite', (initial = '') => ({
        raw: initial || '',

        init() {
            // Initialize visible editor with raw HTML
            if (this.raw && this.$refs.editor) {
                this.$refs.editor.innerHTML = this.raw;
            }
            this.sync(); // ensure hidden + Livewire are in sync
        },

        focus() {
            this.$refs.editor?.focus();
        },

        sync() {
            if (!this.$refs.editor) return;

            this.raw = this.$refs.editor.innerHTML;

            if (this.$refs.hidden) {
                this.$refs.hidden.value = this.raw;

                // Trigger Livewire / normal input listeners
                this.$refs.hidden.dispatchEvent(new Event('input', { bubbles: true }));
                this.$refs.hidden.dispatchEvent(new Event('change', { bubbles: true }));
            }
        },

        command(cmd, value = null) {
            this.focus();
            try {
                document.execCommand(cmd, false, value);
            } catch (e) {
                console.warn('execCommand error', cmd, e);
            }
            this.sync();
        },

        setBlock(tag) {
            this.focus();
            const map = {
                h1: 'H1',
                h2: 'H2',
                p: 'P',
                blockquote: 'BLOCKQUOTE',
                pre: 'PRE',
            };

            const block = map[tag] ?? 'P';

            try {
                document.execCommand('formatBlock', false, block);
            } catch (e) {
                console.warn('formatBlock error', e);
            }

            this.sync();
        },

        toggleList(type) {
            this.focus();
            const cmd = type === 'ordered' ? 'insertOrderedList' : 'insertUnorderedList';
            try {
                document.execCommand(cmd, false, null);
            } catch (e) {
                console.warn('list command error', e);
            }
            this.sync();
        },

        isActive(cmd) {
            // Only reliable when editor is focused
            try {
                this.focus();
                return document.queryCommandState(cmd);
            } catch {
                return false;
            }
        },
    }));


});
