@props([
    'id' => null,
    'name' => '',
    'description' => '',
])

<div @click="$dispatch('edit-role', { id: {{ $id }} })" data-id="{{ $id }}" class="cursor-pointer bg-noir-card border border-gold-soft hover:border-goldenrod hover:-translate-y-2 transition-all rounded-lg p-4 mt-4">
    <h5 class="text-xl font-bold text-goldenrod mb-2">Função: {{ $name }}</h5>
    <p class="text-champagne mb-1"><strong>Descrição:</strong> {{ !empty($description) ? $description : 'Descrição não especificada' }}</p>
</div>
