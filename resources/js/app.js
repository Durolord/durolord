import './bootstrap';

// IMPORTANT:
// Do NOT import Alpine here. Livewire (or your bundle) should provide it.
// We only configure it when Alpine is ready.
document.addEventListener('alpine:init', () => {
    // ========== LAYOUT STATE (theme + sidebar) ==========
    Alpine.data('layoutState', () => ({
        theme: 'system',   // 'light' | 'dark' | 'system'
        dark: false,
        sidebarCollapsed: false,

        init() {
            const saved = localStorage.getItem('duro-theme');
            this.theme = saved ? saved : 'system';
            this.applyTheme();

            const media = window.matchMedia('(prefers-color-scheme: dark)');
            media.addEventListener('change', (e) => {
                if (this.theme === 'system') {
                    this.dark = e.matches;
                    this.updateDom();
                }
            });
        },

        cycleTheme() {
            const order = ['light', 'dark', 'system'];
            let idx = order.indexOf(this.theme);
            if (idx === -1) idx = 0;
            const next = order[(idx + 1) % order.length];
            this.setTheme(next);
        },

        setTheme(mode) {
            this.theme = mode;
            localStorage.setItem('duro-theme', mode);
            this.applyTheme();
        },

        applyTheme() {
            if (this.theme === 'system') {
                this.dark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            } else {
                this.dark = (this.theme === 'dark');
            }
            this.updateDom();
        },

        updateDom() {
            document.documentElement.classList.toggle('dark', this.dark);
            document.body.classList.toggle('bg-aurora-dark', this.dark);
            document.body.classList.toggle('bg-aurora-light', !this.dark);
        },

        toggleSidebar() {
            this.sidebarCollapsed = !this.sidebarCollapsed;
        },
    }));

    // ========== ANIMATED TOOLTIP (default: BOTTOM, with auto-hide) ==========
    Alpine.directive('tooltip', (el, { expression, modifiers }, { evaluate }) => {
        let tooltip = null;
        let hideTimeout = null;      // for fade-out animation
        let autoHideTimeout = null;  // hard time limit

        const placement = modifiers.includes('top')
            ? 'top'
            : modifiers.includes('left')
            ? 'left'
            : modifiers.includes('right')
            ? 'right'
            : 'bottom'; // default: below element

        const cleanup = () => {
            if (hideTimeout) {
                clearTimeout(hideTimeout);
                hideTimeout = null;
            }
            if (autoHideTimeout) {
                clearTimeout(autoHideTimeout);
                autoHideTimeout = null;
            }
            if (tooltip) {
                tooltip.remove();
                tooltip = null;
            }
        };

        const hide = () => {
            if (!tooltip) return;

            // fade + scale out
            tooltip.style.opacity = '0';
            tooltip.style.transform = tooltip.dataset.baseTransform.replace('scale(1)', 'scale(0.95)');

            hideTimeout = setTimeout(() => {
                cleanup();
            }, 150);
        };

        const show = () => {
            // if something was already visible, clean it up first
            cleanup();

            let message = '';

            if (expression) {
                try {
                    message = evaluate(expression);
                } catch (e) {
                    message = expression;
                }
            } else {
                message = el.getAttribute('x-tooltip') || '';
            }

            if (!message) return;

            tooltip = document.createElement('div');
            tooltip.textContent = message;

            tooltip.className = `
                fixed z-50 px-2.5 py-1.5 text-xs rounded-lg
                bg-shadow-900/90 text-neutralfog-200 border border-electric-500/40
                dark:bg-shadow-900/95 dark:text-neutralfog-200 dark:border-electric-500/40
                shadow-lg backdrop-blur-sm pointer-events-none
                transition-all duration-150 ease-out
            `;

            tooltip.style.opacity = '0';

            document.body.appendChild(tooltip);

            const rect = el.getBoundingClientRect();
            const top = rect.top + window.scrollY;
            const left = rect.left + window.scrollX;
            const centerX = left + rect.width / 2;
            const centerY = top + rect.height / 2;

            let baseTransform = '';

            switch (placement) {
                case 'top':
                    tooltip.style.left = `${centerX}px`;
                    tooltip.style.top = `${top - 8}px`;
                    baseTransform = 'translate(-50%, -100%)';
                    break;

                case 'bottom':
                    tooltip.style.left = `${centerX}px`;
                    tooltip.style.top = `${top + rect.height + 8}px`;
                    baseTransform = 'translate(-50%, 0)';
                    break;

                case 'left':
                    tooltip.style.left = `${left - 8}px`;
                    tooltip.style.top = `${centerY}px`;
                    baseTransform = 'translate(-100%, -50%)';
                    break;

                case 'right':
                    tooltip.style.left = `${left + rect.width + 8}px`;
                    tooltip.style.top = `${centerY}px`;
                    baseTransform = 'translate(0, -50%)';
                    break;
            }

            // store base transform for later
            tooltip.dataset.baseTransform = baseTransform + ' scale(1)';

            // start slightly scaled down
            tooltip.style.transform = baseTransform + ' scale(0.95)';

            // animate in
            requestAnimationFrame(() => {
                tooltip.style.opacity = '1';
                tooltip.style.transform = baseTransform + ' scale(1)';
            });

            // hard time limit: auto-hide after 2.5 seconds
            autoHideTimeout = setTimeout(() => {
                hide();
            }, 2500);
        };

        el.addEventListener('mouseenter', show);
        el.addEventListener('mouseleave', hide);
        el.addEventListener('focus', show);
        el.addEventListener('blur', hide);
    });

        // ========== SIMPLE MARKDOWN RENDERER ==========
    window.duroMarkdown = function (src) {
        if (!src || !src.trim()) {
            return '<p class="text-[11px] text-neutral-500 dark:text-neutralfog-400/80">Nothing to preview yet.</p>';
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
            '<a href="$2" class="text-electric-600 dark:text-electric-400 underline">$1</a>'
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
