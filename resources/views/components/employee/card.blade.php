@props([
    'employee' => '',
    'email' => '',
    'phone' => '',
    'id' => null,
    'services' => []
])

<div @click="$dispatch('edit-employee', { id: {{ $id }} })" data-id="{{ $id }}" class="cursor-pointer bg-noir-card border border-gold-soft hover:border-goldenrod hover:-translate-y-2 transition-all rounded-lg p-4 mt-4">
    <h5 class="text-xl font-bold text-goldenrod mb-2">Funcionário: {{ $employee }}</h5>
    <p class="text-champagne mb-1"><strong>Email:</strong> {{ !empty($email) ? $email : 'Email não especificado' }}</p>
    <p class="text-champagne mb-1"><strong>Telefone:</strong> {{ !empty($phone) ? \App\Helpers\PhoneHelper::format($phone) : 'Telefone não especificado' }}</p>
    <p class="text-champagne mb-1"><strong>Serviços:</strong> {{ !empty($services) ? implode(', ', $services) : 'Nenhum serviço atribuído' }}</p>
</div>
