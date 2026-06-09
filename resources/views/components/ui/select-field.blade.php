@props([
    'label'       => '',
    'options'     => [],
    'id'          => '',
    'name'        => '',
    'wireModel'   => '',
    'placeholder' => 'Selecione...',
])

<label for="{{ $id }}" class="block font-bodoni text-champagne font-medium mb-2">
    {{ $label }}
</label>

<div
    wire:ignore
    x-data="select2Livewire('{{ $wireModel }}', '{{ $id }}', '{{ $placeholder }}')"
>
    <select
        name="{{ $name }}"
        id="{{ $id }}"
        {{ $attributes->merge([
            'class' => 'w-full bg-noir-card border border-gold-soft rounded-md py-2 px-4 text-champagne placeholder:text-muted focus:outline-none focus:ring-2 focus:ring-goldenrod transition'
        ]) }}
    >
        <option value="">{{ $placeholder }}</option>

        @foreach($options as $optionId => $optionName)
            <option value="{{ $optionId }}">{{ $optionName }}</option>
        @endforeach
    </select>
</div>
