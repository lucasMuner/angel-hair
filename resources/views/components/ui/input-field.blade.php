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
    {{ $attributes->merge(['class' => 'w-full bg-noir-card border border-gold-soft rounded-md py-2 px-4 text-champagne placeholder:text-muted focus:outline-none focus:ring-2 focus:ring-goldenrod transition']) }}
>
