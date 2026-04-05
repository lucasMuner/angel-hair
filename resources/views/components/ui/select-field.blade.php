@props([
    'label' => '',
    'options' => [],
    'id' => '',
    'name' => '',
    'type' => 'text',
])

<label for="{{ $id }}" class="block font-bodoni text-champagne font-medium mb-2"> {{ $label }} </label>
<select name="{{ $name }}" id="{{ $id }}" {{ $attributes->merge(
        ['class' => 'w-full border border-gray-300 rounded-md py-2 px-4 text-champagne bg-[#2F4F4F] focus:outline-none focus:ring-[#DAA520] focus:ring-2'])
    }}>
    <option value="">Selecione...</option>
    @foreach($options as $id => $name)
        <option value="{{ $id }}">{{ $name }}</option>
    @endforeach
</select>
