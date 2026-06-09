@props([
    'id' => '',
    'employee' => '',
    'client' => '',
    'date' => '',
    'start_time' => '',
    'end_time' => ''
])

<div @click="$dispatch('edit-appointment', { id: {{ $id }} })" class="cursor-pointer bg-noir-card border border-gold-soft hover:border-goldenrod hover:-translate-y-2 transition-all rounded-lg p-4 mt-4">
    <h5 class="text-xl font-bold text-goldenrod mb-2">Agendamento #{{ $id }}</h5>
    <p class="text-champagne mb-1"><strong>Funcionário:</strong> {{ $employee }}</p>
    <p class="text-champagne mb-1"><strong>Cliente:</strong> {{ $client }}</p>
    <p class="text-champagne mb-1"><strong>Data:</strong> {{ !empty($date) ? \Carbon\Carbon::parse($date)->format('d/m/Y') : 'Data não especificada' }}</p>
    <p class="text-champagne mb-1">
        <strong>Início:</strong> {{  \Carbon\Carbon::parse($start_time)->format('H:i') }}  |
        <strong>Término:</strong> {{ \Carbon\Carbon::parse($end_time)->format('H:i') }}
    </p>
</div>
