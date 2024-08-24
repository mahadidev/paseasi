@props(['disabled' => false, 'type' => 'text', 'label' => '', 'name' => '', 'id' => '', 'value' => ''])

<div class="w-full flex flex-col gap-2.5">
    <label for="input_{{ $name }}"
        class="block text-sm font-medium text-gray-900 dark:text-white">{{ $label }}</label>
    <select  id="{{ $id }}" name="{{ $name }}" type="{{ $type }}" value="{{ $value }}" {{ $disabled ? 'disabled' : '' }}
        {!! $attributes->merge([
            'class' =>
                'shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500',
        ]) !!}>{{ $slot }}</select>

    @if ($errors->has($name))
        <p class="text-red-500 text-sm mt-2">{{ $errors->first($name) }}</p>
    @endif
</div>
