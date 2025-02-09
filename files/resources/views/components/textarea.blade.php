@props(['id', 'name', 'value' => '', 'required' => false, 'placeholder' => '', 'rows' => 4, 'cols' => 50])

<div>
    <textarea
        id="{{ $id ?? $name }}"
        name="{{ $name }}"
        {{ $attributes->merge(['class' => 'mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500']) }}
        rows="{{ $rows }}"
        cols="{{ $cols }}"
        placeholder="{{ $placeholder }}"
        @if ($required) required @endif
    >{{ $value }}</textarea>

    <!-- Input error -->
    <x-input-error for="{{ $name }}" class="mt-2" />
</div>
