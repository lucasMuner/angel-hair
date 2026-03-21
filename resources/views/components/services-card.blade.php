@props([
    'service' => '',
    'description' => '',
    'price' => '',
])

<div class="bg-tidewater hover:-translate-y-2 transition-transform rounded-lg p-4 mt-4" style="background-color: #1a3333; border: 1px solid #DAA520;">
    <h5 class="text-xl font-bold text-goldenrod mb-2">Serviço: {{ $service }}</h5>
    <p class="text-champagne mb-1"><strong>Descrição:</strong> {{ $description }}</p>
    <p class="text-champagne mb-1"><strong>Preço:</strong> R$ {{ number_format($price, 2, ',', '.') }}</p>
</div>
