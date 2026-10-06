@props([
    'label' => null,
    'hint' => null,
    'multiple' => false,
])

@php
    // Properly extract the wire:model field name (e.g. "documents")
    $wireModelField = optional($attributes->wire('model'))->value();
@endphp

<div
    class="space-y-2"
    x-data="{
        uploading: false,
        overallProgress: 0,
        files: [],
        isDragging: false,

        syncFilesToPreviews(fileList) {
            const selected = Array.from(fileList || []);
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

        handleChange(event) {
            this.syncFilesToPreviews(event.target.files);
        },

        handleDrop(event) {
            event.preventDefault();
            this.isDragging = false;

            const droppedFiles = event.dataTransfer?.files;
            if (!droppedFiles || !droppedFiles.length) return;

            const dt = new DataTransfer();

            Array.from(droppedFiles).forEach((file, index) => {
                if (this.$refs.input.multiple || index === 0) {
                    dt.items.add(file);
                }
            });

            // Put files on the real <input> so Livewire can see them
            this.$refs.input.files = dt.files;

            // Update Alpine previews
            this.syncFilesToPreviews(this.$refs.input.files);

            // IMPORTANT: Trigger a real change event so Livewire uploads
            this.$refs.input.dispatchEvent(new Event('change', { bubbles: true }));
        },

        startUpload() {
            this.uploading = true;
            this.overallProgress = 0;
            this.files.forEach((f) => f.progress = 0);
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

            const dt = new DataTransfer();
            // Keep only the files that still have previews
            Array.from(this.$refs.input.files).forEach((file) => {
                const stillPresent = this.files.find(
                    f => f.name === file.name && f.size === file.size
                );
                if (stillPresent) {
                    dt.items.add(file);
                }
            });
            this.$refs.input.files = dt.files;

            // Fire change so Livewire updates its pending upload list
            this.$refs.input.dispatchEvent(new Event('change', { bubbles: true }));
        },

        formatSize(bytes) {
            if (bytes === undefined || bytes === null) return '';
            const mb = bytes / 1024 / 1024;
            if (mb < 1) {
                return (bytes / 1024).toFixed(1) + ' KB';
            }
            return mb.toFixed(2) + ' MB';
        },
    }"
    x-on:livewire-upload-start="startUpload()"
    x-on:livewire-upload-progress="updateProgress($event.detail.progress)"
    x-on:livewire-upload-error="uploading = false"
    x-on:livewire-upload-finish="finishUpload()"
>
    {{-- Label --}}
    @if($label)
        <label class="duro-label">
            {{ $label }}
        </label>
    @endif

    {{-- Dropzone --}}
    <label
        class="relative flex flex-col items-center justify-center gap-2 rounded-ui border-2 border-dashed
 border-line bg-surface-2/60 px-4 py-6 text-center cursor-pointer
               text-xs text-ink-muted hover:border-primary hover:bg-surface-2

                transition-colors duration-150"
        :class="isDragging ? 'border-primary bg-surface-2 ' : ''"
        x-on:dragover.prevent
        x-on:dragenter.prevent="isDragging = true"
        x-on:dragleave.prevent="isDragging = false"
        x-on:drop="handleDrop($event)"
    >
        <span class="text-[11px] uppercase tracking-[0.16em] text-ink-subtle ">
            Drop files here or click to upload
        </span>
        <span class="text-[11px] text-ink-subtle ">
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
    @if($wireModelField)
        @error($wireModelField)
            <div class="inline-flex items-center gap-2 mt-1 rounded-full bg-crimson-50 px-3 py-1.5
 text-[11px] text-crimson-700 border border-crimson-100
                        dark:bg-crimson-900/20 dark:text-crimson-200 dark:border-crimson-800/80">
                <span class="inline-block h-1.5 w-1.5 rounded-full bg-crimson-500 dark:bg-crimson-300"></span>
                <span>{{ $message }}</span>
            </div>
        @enderror
    @endif

    {{-- Overall upload progress --}}
    <div x-show="uploading" x-transition.opacity class="mt-2 space-y-1">
        <div class="h-1.5 rounded-full bg-surface-2/70 overflow-hidden">
            <div
                class="h-1.5 bg-primary rounded-full transition-all duration-150"
                :style="`width: ${overallProgress}%;`"
            ></div>
        </div>
        <p class="text-[11px] text-ink-subtle ">
            Uploading… <span x-text="overallProgress"></span>%
        </p>
    </div>

    {{-- File previews --}}
    <div class="mt-4 space-y-2">
        <template x-for="file in files" :key="file.id">
            <div
                class="flex items-center gap-3 p-2.5 rounded-ui border border-line/80 bg-surface-2/70

 shadow-sm hover:shadow-md transition-shadow duration-150"
                x-transition.opacity.scale.duration.150ms
            >
                {{-- Thumbnail / icon --}}
                <div class="relative">
                    {{-- Image preview --}}
                    <template x-if="file.isImage">
                        <div class="h-12 w-12 rounded-md overflow-hidden bg-surface-3/40">
                            <img :src="file.previewUrl" alt=""
                                 class="h-full w-full object-cover">
                        </div>
                    </template>

                    {{-- PDF thumbnail --}}
                    <template x-if="file.isPdf">
                        <div class="h-12 w-12 flex flex-col items-center justify-center rounded-md
 bg-primary/10 border border-primary/40
                                    text-[10px] font-semibold text-primary-ink
                                     ">
                            <span class="leading-none">PDF</span>
                            <span class="text-[9px] font-normal mt-0.5">Document</span>
                        </div>
                    </template>

                    {{-- Generic file icon --}}
                    <template x-if="!file.isImage && !file.isPdf">
                        <div class="h-12 w-12 flex items-center justify-center rounded-md
 bg-surface-2/80
                                    text-[10px] uppercase text-ink-muted ">
                            <span x-text="(file.type.split('/')[1] || 'file').slice(0,4)"></span>
                        </div>
                    </template>
                </div>

                {{-- File info + individual progress --}}
                <div class="flex-1 min-w-0 space-y-1">
                    <p class="truncate text-xs font-medium text-ink " x-text="file.name"></p>
                    <p class="text-[11px] text-ink-subtle ">
                        <span x-text="formatSize(file.size)"></span>
                    </p>

                    <div class="h-1.5 rounded-full bg-surface-2/70 overflow-hidden">
                        <div
                            class="h-1.5 bg-primary rounded-full transition-all duration-150"
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
