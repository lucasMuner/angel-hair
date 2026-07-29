<div class="max-w-2xl mx-auto px-4 py-8">

    {{-- Indicador de progresso --}}
    <div class="flex items-center justify-center gap-2 mb-8">
        @foreach(range(1, 5) as $s)
            <div class="h-1.5 rounded-full transition-all duration-500 {{ $step >= $s ? 'w-8 bg-goldenrod' : 'w-4 bg-noir-card' }}"></div>
        @endforeach
    </div>

    {{-- STEP 1: Selecionar Serviço --}}
    @if($step === 1)
        <div wire:key="step-1" x-data x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0">
            <h2 class="text-2xl font-bold text-goldenrod text-center mb-6 font-cinzel">Escolha o Serviço</h2>

            <div class="grid grid-cols-2 gap-4">
                @foreach($this->services as $service)
                    <button
                        wire:click="selectService({{ $service->id }})"
                        wire:key="service-{{ $service->id }}"
                        class="flex flex-col items-center text-center p-5 rounded-xl bg-noir-card border border-gold-soft hover:border-goldenrod hover:-translate-y-1 transition-all cursor-pointer"
                    >
                        <i class="fa-solid fa-scissors text-3xl text-goldenrod mb-3"></i>
                        <p class="text-champagne font-medium text-sm truncate w-full">{{ $service->name }}</p>
                        <p class="text-muted text-xs mt-1">R$ {{ number_format($service->price, 2, ',', '.') }}</p>
                    </button>
                @endforeach
            </div>
        </div>
    @endif

    {{-- STEP 2: Selecionar Funcionário --}}
    @if($step === 2)
        <div wire:key="step-2" x-data x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0">
            <button wire:click="backTo(1)" class="text-muted hover:text-goldenrod text-sm mb-4 flex items-center gap-1">
                <i class="fa-solid fa-arrow-left"></i> Voltar
            </button>

            <h2 class="text-2xl font-bold text-goldenrod text-center mb-6 font-cinzel">Escolha o Profissional</h2>

            <div class="flex flex-col gap-3">
                @forelse($this->employees as $employee)
                    <button
                        wire:click="selectEmployee({{ $employee->id }})"
                        wire:key="employee-{{ $employee->id }}"
                        class="flex items-center gap-4 p-4 rounded-xl bg-noir-card border border-gold-soft hover:border-goldenrod transition-all text-left"
                    >
                        <div class="w-14 h-14 rounded-full bg-noir-deep flex items-center justify-center overflow-hidden flex-shrink-0">
                            <i class="fa-solid fa-user text-xl text-goldenrod/50"></i>
                        </div>
                        <span class="text-champagne font-medium">{{ $employee->user->name }}</span>
                    </button>
                @empty
                    <p class="text-muted text-center">Nenhum profissional disponível para esse serviço.</p>
                @endforelse
            </div>
        </div>
    @endif

    {{-- STEP 3: Selecionar Data --}}
    @if($step === 3)
        <div wire:key="step-3" x-data x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0">
            <button wire:click="backTo(2)" class="text-muted hover:text-goldenrod text-sm mb-4 flex items-center gap-1">
                <i class="fa-solid fa-arrow-left"></i> Voltar
            </button>

            <h2 class="text-2xl font-bold text-goldenrod text-center mb-6 font-cinzel">Escolha a Data</h2>

            <input
                type="date"
                wire:model.live="date"
                min="{{ now()->format('Y-m-d') }}"
                class="w-full px-4 py-3 rounded-lg bg-noir-card border border-gold-soft text-champagne focus:border-goldenrod outline-none"
            >
        </div>
    @endif

    {{-- STEP 4: Selecionar Horário --}}
    @if($step === 4)
        <div wire:key="step-4" x-data x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0">
            <button wire:click="backTo(3)" class="text-muted hover:text-goldenrod text-sm mb-4 flex items-center gap-1">
                <i class="fa-solid fa-arrow-left"></i> Voltar
            </button>

            <h2 class="text-2xl font-bold text-goldenrod text-center mb-6 font-cinzel">Escolha o Horário</h2>

            @if(count($availableTimes) > 0)
                <div class="grid grid-cols-3 gap-2">
                    @foreach($availableTimes as $i => $time)
                        <button
                            wire:click="selectTime('{{ $time }}')"
                            wire:key="time-{{ $time }}"
                            x-data
                            x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 scale-90"
                            x-transition:enter-end="opacity-100 scale-100"
                            style="transition-delay: {{ $i * 40 }}ms"
                            class="px-3 py-2 rounded-full bg-noir-card border border-gold-soft text-champagne hover:bg-goldenrod hover:text-noir-deep hover:border-goldenrod transition-all"
                        >
                            {{ $time }}
                        </button>
                    @endforeach
                </div>
            @else
                <p class="text-muted text-center">Nenhum horário disponível nessa data.</p>
            @endif
        </div>
    @endif

    {{-- STEP 5: Confirmar --}}
    @if($step === 5)
        <div wire:key="step-5" x-data x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0">
            <button wire:click="backTo(4)" class="text-muted hover:text-goldenrod text-sm mb-4 flex items-center gap-1">
                <i class="fa-solid fa-arrow-left"></i> Voltar
            </button>

            <h2 class="text-2xl font-bold text-goldenrod text-center mb-6 font-cinzel">Confirme seu Agendamento</h2>

            <div class="rounded-xl bg-noir-card border border-gold-soft p-6 space-y-3 mb-6">
                <div class="flex justify-between">
                    <span class="text-muted">Serviço</span>
                    <span class="text-champagne font-medium">{{ \App\Models\Service::find($service_id)?->name }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-muted">Profissional</span>
                    <span class="text-champagne font-medium">{{ \App\Models\Employee::find($employee_id)?->user?->name }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-muted">Data</span>
                    <span class="text-champagne font-medium">{{ \Carbon\Carbon::parse($date)->format('d/m/Y') }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-muted">Horário</span>
                    <span class="text-champagne font-medium">{{ $start_time }}</span>
                </div>
            </div>

            <div class="flex gap-3">
                <button wire:click="restart" class="flex-1 px-4 py-3 rounded-lg bg-noir-card border border-gold-soft text-champagne hover:border-goldenrod transition">
                    Cancelar
                </button>
                <button wire:click="confirm" wire:loading.attr="disabled" class="flex-1 px-4 py-3 rounded-lg bg-goldenrod text-noir-deep font-medium hover:bg-goldenrod-dark transition">
                    <span wire:loading.remove>Agendar</span>
                    <span wire:loading>Agendando...</span>
                </button>
            </div>
        </div>
    @endif

    {{-- STEP 6: Sucesso --}}
    @if($step === 6)
        <div wire:key="step-6" x-data x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100" class="text-center py-10">
            <i class="fa-solid fa-circle-check text-6xl text-goldenrod mb-4"></i>
            <h2 class="text-2xl font-bold text-goldenrod mb-2 font-cinzel">Agendamento Confirmado!</h2>
            <p class="text-muted mb-6">Você receberá os detalhes em breve.</p>
            <button wire:click="restart" class="px-6 py-3 rounded-lg bg-goldenrod text-noir-deep font-medium hover:bg-goldenrod-dark transition">
                Fazer Novo Agendamento
            </button>
        </div>
    @endif

    <div
        x-data
        x-on:alert.window="
            Swal.fire({
                icon: $event.detail.type,
                title: $event.detail.type === 'success' ? 'Sucesso!' : 'Erro!',
                text: $event.detail.message,
                confirmButtonColor: '#DAA520'
            })
        "
    ></div>

</div>
