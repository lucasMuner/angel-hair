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
            'class' => 'w-full border border-gray-300 rounded-md py-2 px-4 text-champagne bg-[#2F4F4F] focus:outline-none focus:ring-[#DAA520] focus:ring-2'
        ]) }}
    >
        <option value="">{{ $placeholder }}</option>

        @foreach($options as $optionId => $optionName)
            <option value="{{ $optionId }}">{{ $optionName }}</option>
        @endforeach
    </select>
</div>
