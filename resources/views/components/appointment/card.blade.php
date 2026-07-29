@props([
    'id' => '',
    'employee' => '',
    'client' => '',
    'date' => '',
    'start_time' => '',
    'end_time' => ''
])

@php
    $isClient = auth()->user()->role->name === 'client';
@endphp

<div
    @if(!$isClient)
        @click="$dispatch('edit-appointment', { id: {{ $id }} })"
    @endif
    class="relative {{ !$isClient ? 'cursor-pointer' : '' }} bg-noir-card border border-gold-soft hover:border-goldenrod hover:-translate-y-2 transition-all rounded-lg p-4"
>
    @if($isClient)
        <button
            type="button"
            @click.stop="
                Swal.fire({
                    title: 'Tem certeza?',
                    text: 'Essa ação não pode ser desfeita!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#DAA520',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sim, excluir!',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $dispatch('delete-appointment', { id: {{ $id }} });
                    }
                });
            "
            class="cursor-pointer absolute top-3 right-3 z-10 w-7 h-7 flex items-center justify-center rounded-full text-red-400 hover:text-red-500 hover:bg-red-950 transition"
        >
            <i class="fa-solid fa-trash text-sm"></i>
        </button>
    @endif

    <h5 class="text-xl font-bold text-goldenrod mb-2 {{ $isClient ? 'pr-8' : '' }}">Agendamento #{{ $id }}</h5>
    <p class="text-champagne mb-1"><strong>Funcionário:</strong> {{ $employee }}</p>
    <p class="text-champagne mb-1"><strong>Cliente:</strong> {{ $client }}</p>
    <p class="text-champagne mb-1"><strong>Data:</strong> {{ !empty($date) ? \Carbon\Carbon::parse($date)->format('d/m/Y') : 'Data não especificada' }}</p>
    <p class="text-champagne mb-1">
        <strong>Início:</strong> {{ \Carbon\Carbon::parse($start_time)->format('H:i') }} |
        <strong>Término:</strong> {{ \Carbon\Carbon::parse($end_time)->format('H:i') }}
    </p>
</div>
