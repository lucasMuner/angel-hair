@props([
    'appointment' => '',
    'employee' => '',
    'client' => '',
    'date' => '',
    'time' => '',
])

<div class="bg-tidewater hover:-translate-y-2 transition-transform rounded-lg p-4 mt-4" style="background-color: #1a3333; border: 1px solid #DAA520;">
    <h5 class="text-xl font-bold text-goldenrod mb-2">Agendamento #{{ $appointment }}</h5>
    <p class="text-champagne mb-1"><strong>Funcionário:</strong> {{ $employee }}</p>
    <p class="text-champagne mb-1"><strong>Cliente:</strong> {{ $client }}</p>
    <p class="text-champagne mb-1"><strong>Data:</strong> {{ !empty($date) ? \Carbon\Carbon::parse($date)->format('d/m/Y') : 'Data não especificada' }}</p>
    <p class="text-champagne mb-1"><strong>Horário:</strong> {{ $time }}</p>
</div>
