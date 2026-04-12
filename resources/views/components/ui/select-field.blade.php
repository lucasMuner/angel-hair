@props([
    'label' => '',
    'options' => [],
    'id' => '',
    'name' => '',
    'type' => 'text',
    'hidden' => false,
    'multiple' => false
])

<label for="{{ $id }}" class="block font-bodoni text-champagne font-medium mb-2"> {{ $label }} </label>
<select name="{{ $multiple ? $name.'[]' : $name }}" id="{{ $id }}" {{ $multiple ? 'multiple' : '' }}
    {{ $attributes->merge([
        'class' => 'w-full border border-gray-300 rounded-md py-2 px-4 text-champagne bg-[#2F4F4F] focus:outline-none focus:ring-[#DAA520] focus:ring-2'
            . ($multiple ? ' h-40' : '')
    ]) }}
>
    @if(!$multiple)
        <option value="">Selecione...</option>
    @endif

    @foreach($options as $optionId => $optionName)
        <option value="{{ $optionId }}">{{ $optionName }}</option>
    @endforeach
</select>
@if($multiple)
    <p class="text-xs text-champagne mt-1">Segure Ctrl (ou Cmd no Mac) para selecionar vários</p>
@endif

