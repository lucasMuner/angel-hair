@props([
    'label'       => '',
    'options'     => [],
    'id'          => '',
    'name'        => '',
    'wireModel'   => '',
    'placeholder' => 'Selecione as opções...',
])

<label for="{{ $id }}" class="block font-bodoni text-champagne font-medium mb-2">
    {{ $label }}
</label>

<div
    wire:ignore
    x-data="select2Livewire('{{ $wireModel }}', '{{ $id }}', '{{ $placeholder }}')"
>
    <select id="{{ $id }}" name="{{ $name }}[]" multiple class="w-full">
        @foreach($options as $optionId => $optionName)
            <option value="{{ $optionId }}">{{ $optionName }}</option>
        @endforeach
    </select>
</div>
