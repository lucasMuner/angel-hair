<x-layouts.main-layout title="Home" active="home">

    {{-- Hero --}}
    <div class="min-h-[500px] flex flex-col items-center justify-center w-full font-bodoni p-8 relative overflow-hidden" style="background-color: #111111;">

        {{-- Padrão Art Déco SVG --}}
        <x-ui.art-deco-bg />

        {{-- Conteúdo --}}
        <div class="relative z-10 text-center max-w-2xl">
            <p class="text-xs tracking-[0.4em] text-goldenrod mb-4 font-sans uppercase opacity-70">Studio de Beleza</p>
            <h1 class="text-6xl font-bold text-goldenrod mb-6 leading-tight">Angel Hair</h1>
            <div class="flex items-center justify-center gap-4 mb-6">
                <div class="h-px w-16 bg-goldenrod opacity-40"></div>
                <div class="w-1.5 h-1.5 rounded-full bg-goldenrod opacity-60"></div>
                <div class="h-px w-16 bg-goldenrod opacity-40"></div>
            </div>
            <p class="text-base text-champagne leading-relaxed opacity-80 max-w-lg mx-auto">
                Bem-vindo ao seu painel de controle. Gerencie agendamentos, clientes e serviços com praticidade.
            </p>
        </div>

    </div>

    {{-- Visão Geral --}}
    <div class="min-h-[500px] flex flex-col w-full font-bodoni bg-noir-deep p-8">

        <livewire:service.service-carousel />

        {{-- Fios ao vento — transição entre Hero e Visão Geral --}}
        <div class="w-full bg-noir-deep">
            <x-ui.hair-wind :height="300" :strands="100" :wind="1" :speed="0.8" />
        </div>


        {{-- Acesso Rápido --}}
        <h2 class="text-3xl font-bold text-goldenrod text-center mb-6 mt-4">Acesso Rápido</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
            <a href="{{ route('booking.wizard') }}" class="rounded-xl hover:-translate-y-2 transition-all p-6 flex items-center gap-4 bg-noir-card border border-gold-soft hover:border-goldenrod">
                <i class="fa-solid fa-calendar-plus text-3xl text-goldenrod"></i>
                <div>
                    <p class="text-goldenrod font-bold text-lg">Novo Agendamento</p>
                    <p class="text-muted text-sm">Agende um novo horário</p>
                </div>
            </a>
            <a href="#" class="rounded-xl hover:-translate-y-2 transition-all p-6 flex items-center gap-4 bg-noir-card border border-gold-soft hover:border-goldenrod">
                <i class="fa-solid fa-calendar-days text-3xl text-goldenrod"></i>
                <div>
                    <p class="text-goldenrod font-bold text-lg">Ver Agendamentos</p>
                    <p class="text-muted text-sm">Visualize o calendário</p>
                </div>
            </a>
            <a href="#" class="rounded-xl hover:-translate-y-2 transition-all p-6 flex items-center gap-4 bg-noir-card border border-gold-soft hover:border-goldenrod">
                <i class="fa-solid fa-user text-3xl text-goldenrod"></i>
                <div>
                    <p class="text-goldenrod font-bold text-lg">Perfil</p>
                    <p class="text-muted text-sm">Acesse suas informações</p>
                </div>
            </a>
        </div>
    </div>

</x-layouts.main-layout>
