@props(['disabled' => false, 'type' => 'text', 'label' => '', 'name' => '', 'id' => '', 'value' => '', 'required' => false])

<div class="w-full flex flex-col gap-2.5" >
    <label for="input_{{ $id }}"
        class="flex gap-1 items-center text-sm font-medium text-black">{{ $label }}
        @if($required)
            <span class="text-red-700">*</span>
        @endif
    </label>

    <div class="relative rounded-lg overflow-hidden">
        <input id="input_{{ $id }}" name="{{ $name }}"  value="{{ $value }}"
            {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
                'class' =>
                    'shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm  focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 rounded-lg',
            ]) !!} {{ $required ? "required" : ""}}>
    </div>

    @if ($errors->has($name))
        <p class="text-red-500 text-sm mt-2">{{ $errors->first($name) }}</p>
    @endif
</div>

