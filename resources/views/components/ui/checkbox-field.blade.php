@props([
    'label' => '',
    'id'    => '',
    'name'  => '',
    'value' => '',
])

<div class="flex items-center justify-between gap-3 p-3 bg-noir-card rounded-lg border border-goldenrod">
    <label for="{{ $id }}" class="text-champagne text-sm cursor-pointer">
        {{ $label }}
    </label>

    <label class="relative inline-block w-11 h-6 cursor-pointer">
        <input
            type="checkbox"
            id="{{ $id }}"
            name="{{ $name }}"
            value="{{ $value }}"
            {{ old($name) ? 'checked' : '' }}
            class="sr-only peer"
        >
        <div class="toggle-track w-full h-full bg-gray-600 rounded-full transition-colors duration-300">
            <div class="toggle-thumb absolute top-1 left-1 w-4 h-4 bg-white rounded-full transition-transform duration-300"></div>
        </div>
    </label>
</div>
