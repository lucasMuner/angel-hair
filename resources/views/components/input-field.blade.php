@props([
    'label' => '',
    'id' => '',
    'name' => '',
    'type' => 'text',
])

<label for="{{ $id }}" class="block font-bodoni text-champagne font-medium mb-2"> {{ $label }} </label>
<input
    type="{{ $type }}"
    id="{{ $id }}"
    name="{{ $name }}"
    {{ $attributes->merge(['class' => 'w-full border border-gray-300 rounded-md py-2 px-4 text-champagne focus:outline-none focus:ring-[#DAA520] focus:ring-2']) }}
>
