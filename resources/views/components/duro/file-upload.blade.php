@props([
    'label' => null,
    'hint' => null,
    'multiple' => false,
])

@php
    // Get the wire:model field name so we can show validation errors
    $wireModelField = $attributes->whereStartsWith('wire:model')->first();
@endphp

<div
    class="space-y-2"
    x-data="{
        uploading: false,
        overallProgress: 0,
        files: [],

        handleChange(event) {
            const selected = Array.from(event.target.files || []);
            this.files = selected.map((file, index) => ({
                id: `${file.name}-${index}-${Date.now()}`,
                name: file.name,
                size: file.size,
                type: file.type || 'application/octet-stream',
                isImage: (file.type || '').startsWith('image/'),
                isPdf: (file.type || '') === 'application/pdf',
                previewUrl: (file.type || '').startsWith('image/')
                    ? URL.createObjectURL(file)
                    : null,
                progress: 0,
            }));
        },

        startUpload() {
            this.uploading = true;
            this.overallProgress = 0;
        },

        updateProgress(p) {
            this.overallProgress = p;
            this.files.forEach((f) => f.progress = p);
        },

        finishUpload() {
            this.uploading = false;
            this.overallProgress = 100;
            this.files.forEach((f) => f.progress = 100);
        },

        removeFile(id) {
            this.files = this.files.filter(f => f.id !== id);

            // Rebuild input FileList to match remaining previews
            const dt = new DataTransfer();
            Array.from(this.$refs.input.files).forEach((file) => {
                const stillPresent = this.files.find(
                    f => f.name === file.name && f.size === file.size
                );
                if (stillPresent) {
                    dt.items.add(file);
                }
            });
            this.$refs.input.files = dt.files;
        },

        formatSize(bytes) {
            if (!bytes && bytes !== 0) return '';
            const mb = bytes / 1024 / 1024;
            if (mb < 1) {
                return (bytes / 1024).toFixed(1) + ' KB';
            }
            return mb.toFixed(2) + ' MB';
        },
    }"
    x-on:livewire-upload-start="startUpload()"
    x-on:livewire-upload-progress="updateProgress($event.detail.progress)"
    x-on:livewire-upload-error="finishUpload()"
    x-on:livewire-upload-finish="finishUpload()"
>
    {{-- Label --}}
    @if($label)
        <label class="block text-xs font-medium tracking-[0.14em] uppercase text-neutral-700 dark:text-neutralfog-300">
            {{ $label }}
        </label>
    @endif

    {{-- Dropzone --}}
    <label
        class="relative flex flex-col items-center justify-center gap-2 rounded-xl border-2 border-dashed
               border-neutralfog-300 bg-neutralfog-100/60 px-4 py-6 text-center cursor-pointer
               text-xs text-neutral-600 hover:border-electric-400 hover:bg-neutralfog-100
               dark:border-shadow-700 dark:bg-shadow-950/60 dark:text-neutralfog-300
               dark:hover:border-electric-400/80 transition-colors duration-150"
    >
        <span class="text-[11px] uppercase tracking-[0.16em] text-neutral-500 dark:text-neutralfog-400">
            Drop files here or click to upload
        </span>
        <span class="text-[11px] text-neutral-500 dark:text-neutralfog-400">
            {{ $hint ?? 'Max 10MB per file' }}
        </span>

        <input
            x-ref="input"
            type="file"
            {{ $attributes->class('hidden') }}
            @if($multiple) multiple @endif
            x-on:change="handleChange($event)"
        >
    </label>

    {{-- Validation bubble --}}
    @error($wireModelField)
        <div class="inline-flex items-center gap-2 mt-1 rounded-full bg-crimson-50 px-3 py-1.5
                    text-[11px] text-crimson-700 border border-crimson-100
                    dark:bg-crimson-900/20 dark:text-crimson-200 dark:border-crimson-800/80">
            <span class="inline-block h-1.5 w-1.5 rounded-full bg-crimson-500 dark:bg-crimson-300"></span>
            <span>{{ $message }}</span>
        </div>
    @enderror

    {{-- Overall upload progress --}}
    <div x-show="uploading" x-transition.opacity class="mt-2 space-y-1">
        <div class="h-1.5 rounded-full bg-neutralfog-200/70 dark:bg-shadow-900 overflow-hidden">
            <div
                class="h-1.5 bg-electric-500 dark:bg-electric-400 rounded-full transition-all duration-150"
                :style="`width: ${overallProgress}%;`"
            ></div>
        </div>
        <p class="text-[11px] text-neutral-500 dark:text-neutralfog-400">
            Uploading… <span x-text="overallProgress"></span>%
        </p>
    </div>

    {{-- File previews --}}
    <div class="mt-4 space-y-2">
        <template x-for="file in files" :key="file.id">
            <div
                class="flex items-center gap-3 p-2.5 rounded-lg border border-neutralfog-300/80 bg-neutralfog-100/70
                       dark:border-shadow-800 dark:bg-shadow-950/80
                       shadow-sm hover:shadow-md transition-shadow duration-150"
                x-transition.opacity.scale.duration.150ms
            >
                {{-- Thumbnail / icon --}}
                <div class="relative">
                    {{-- Image preview --}}
                    <template x-if="file.isImage">
                        <div class="h-12 w-12 rounded-md overflow-hidden bg-shadow-900/40">
                            <img :src="file.previewUrl" alt=""
                                 class="h-full w-full object-cover">
                        </div>
                    </template>

                    {{-- PDF thumbnail --}}
                    <template x-if="file.isPdf">
                        <div class="h-12 w-12 flex flex-col items-center justify-center rounded-md
                                    bg-electric-500/10 border border-electric-500/40
                                    text-[10px] font-semibold text-electric-700
                                    dark:bg-electric-400/10 dark:text-electric-300">
                            <span class="leading-none">PDF</span>
                            <span class="text-[9px] font-normal mt-0.5">Document</span>
                        </div>
                    </template>

                    {{-- Generic file icon --}}
                    <template x-if="!file.isImage && !file.isPdf">
                        <div class="h-12 w-12 flex items-center justify-center rounded-md
                                    bg-neutralfog-200/80 dark:bg-shadow-800
                                    text-[10px] uppercase text-neutral-600 dark:text-neutralfog-300">
                            <span x-text="(file.type.split('/')[1] || 'file').slice(0,4)"></span>
                        </div>
                    </template>
                </div>

                {{-- File info + individual progress --}}
                <div class="flex-1 min-w-0 space-y-1">
                    <p class="truncate text-xs font-medium text-neutral-800 dark:text-neutralfog-100" x-text="file.name"></p>
                    <p class="text-[11px] text-neutral-500 dark:text-neutralfog-400">
                        <span x-text="formatSize(file.size)"></span>
                    </p>

                    {{-- Per-file progress bar (mirrors overall progress) --}}
                    <div class="h-1.5 rounded-full bg-neutralfog-200/70 dark:bg-shadow-900 overflow-hidden">
                        <div
                            class="h-1.5 bg-electric-500 dark:bg-electric-400 rounded-full transition-all duration-150"
                            :style="`width: ${file.progress}%;`"
                        ></div>
                    </div>
                </div>

                {{-- Remove button --}}
                <button
                    type="button"
                    class="text-[11px] px-2 py-1 rounded-md text-crimson-600 dark:text-crimson-300
                           hover:bg-crimson-50 dark:hover:bg-crimson-900/30 transition-colors duration-150"
                    x-on:click="removeFile(file.id)"
                >
                    Remove
                </button>
            </div>
        </template>
    </div>
</div>
