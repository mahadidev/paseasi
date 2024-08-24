@props([
    'disabled' => false,
    'label' => $label,
    'name' => $name,
    'preview' => null,
    'value' => null,
    'disabled' => false,
    'required' => false,
])

<div x-data="{{ $name }}()" x-init="initState()" class="w-full flex flex-col gap-2.5">
    <label for="{{ $name }}"
        class="block text-sm font-medium text-black dark:text-white">{{ $label }}</label>
    <div class="w-full dark:bg-gray-600 relative rounded-xl overflow-hidden border-dashed border" x-ref="previewArea"
         x-resize="setPreviewHeight($width)" :style="'height: ' + height + 'px'">

        <input type="file" id="{{ $name }}" name="{{ $name }}"
            class=" absolute top-0 left-0 w-full h-full opacity-0 cursor-pointer z-30" {{ $required ? 'required' : '' }}
            x-on:change="onChange($event.target)" />

        <div class="absolute w-full h-full z-[15] bg-primary-50 dark:bg-slate-900 hidden " id="preview_wrapper_{{ $name }}"
            :class="defaultPreview ? '!block' : ''">
            <img id="preview_{{ $name }}"
                class="w-full h-full object-cover object-center top-0 relative z-10" :src="defaultPreview"
                alt="Preview" />
        </div>

        <div class="w-full h-full bg-blue-50 dark:bg-slate-900/75 absolute  flex-col justify-center items-center gap-0.5 z-10 p-2.5 hidden"
            :class="!defaultPreview ? '!flex' : ''">
            <svg class="w-12 h-12 text-blue-600 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m3 16 5-7 6 6.5m6.5 2.5L16 13l-4.286 6M14 10h.01M4 19h16a1 1 0 0 0 1-1V6a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1Z" />
            </svg>
        </div>
    </div>

    @if ($errors->has($name))
        <p class="text-red-500 text-sm mt-2">{{ $errors->first($name) }}</p>
    @endif
</div>


<script type="text/javascript">
    function {{ $name }}() {
        return {
            width: 0,
            height: 0,
            initState() {
                this.setPreviewHeight(this.$refs.previewArea.clientWidth / 2)
            },
            defaultPreview: "{{ $preview }}",
            onChange(target) {
                const preview = document.getElementById('preview_{{ $name }}');
                const previewWrapper = document.getElementById('preview_wrapper_{{ $name }}');
                const file = target.files[0];
                const reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                    previewWrapper.classList.remove('hidden');
                }

                if (file) {
                    reader.readAsDataURL(file);
                } else {
                    preview.src = '';
                    preview.classList.add('hidden');
                    previewWrapper.classList.add('hidden');
                }
            },
            setPreviewHeight(height) {
                this.height = height;
            }
        }
    }
</script>
