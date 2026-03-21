@props([
    'client' => '',
    'email' => '',
    'phone' => '',
])

<div class="bg-tidewater hover:-translate-y-2 transition-transform rounded-lg p-4 mt-4" style="background-color: #1a3333; border: 1px solid #DAA520;">
    <h5 class="text-xl font-bold text-goldenrod mb-2">Cliente: {{ $client }}</h5>
    <p class="text-champagne mb-1"><strong>Email:</strong> {{ $email }}</p>
    <p class="text-champagne mb-1"><strong>Telefone:</strong> {{ $phone }}</p>
</div>
