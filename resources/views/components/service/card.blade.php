@props([
    'name' => '',
    'description' => '',
    'price' => '',
    'duration' => '',
    'id' => null,
])

<div @click="$dispatch('edit-service', { id: {{ $id }} })" class="cursor-pointer bg-noir-card border border-gold-soft hover:border-goldenrod hover:-translate-y-2 transition-all rounded-lg p-4">
    <h5 class="text-xl font-bold text-goldenrod mb-2">Serviço: {{ $name }}</h5>
    <p class="text-champagne mb-1"><strong>Descrição:</strong> {{ $description }}</p>
    <p class="text-champagne mb-1"><strong>Preço:</strong> R$ {{ number_format($price, 2, ',', '.') }}</p>
    <p class="text-champagne mb-1"><strong>Duração:</strong> {{ \App\Helpers\DurationHelper::format($duration) }}</p>
</div>
