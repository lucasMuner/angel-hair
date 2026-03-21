<x-layouts.main-layout title="Home" active="home">

    <div class="min-h-[500px] flex flex-col items-center justify-center w-full font-bodoni p-8 relative"
         style="background-image: url('{{ asset('assets/img/salao.jpg') }}'); background-size: cover; background-position: center;">

        {{-- Overlay escuro para legibilidade --}}
        <div class="absolute inset-0" style="background-color: rgba(47, 79, 79, 0.75);"></div>

        {{-- Conteúdo --}}
        <div class="relative z-10 text-center">
            <h1 class="text-6xl font-bold text-goldenrod mb-4">Bem-vindo ao Angel Hair!</h1>
            <p class="text-xl text-champagne px-6">
                Este é o seu painel de controle, criado para facilitar o cuidado com você. Aqui você pode agendar seus horários, visualizar o calendário, acompanhar seus atendimentos e organizar tudo de forma prática e rápida.
                Escolha o melhor dia e horário, gerencie seus agendamentos com poucos cliques e tenha mais tempo para o que realmente importa: se sentir linda e confiante. 💖
                Estamos aqui para tornar sua experiência simples, ágil e cheia de estilo. Aproveite! 🌟</p>
        </div>

    </div>

    <div class="min-h-[500px] flex flex-col w-full font-bodoni bg-esmeralda p-8 relative">

        {{-- Título --}}
        <h2 class="text-3xl font-bold text-goldenrod text-center mb-8">Visão Geral</h2>

        {{-- Estatísticas --}}
        <div class="grid grid-cols-3 gap-6 mb-10">
            <div class="rounded-xl hover:-translate-y-2 transition-transform p-6 text-center bg-tidewater" style="background-color: #1a3333; border: 1px solid #DAA520;">
                <i class="fa-solid fa-calendar-check text-3xl mb-3" style="color: #DAA520;"></i>
                <p class="text-4xl font-bold text-goldenrod">8</p>
                <p class="text-champagne text-sm mt-1">Agendamentos Hoje</p>
            </div>
            <div class="rounded-xl hover:-translate-y-2 transition-transform p-6 text-center bg-tidewater" style="background-color: #1a3333; border: 1px solid #DAA520;">
                <i class="fa-solid fa-users text-3xl mb-3" style="color: #DAA520;"></i>
                <p class="text-4xl font-bold text-goldenrod">3</p>
                <p class="text-champagne text-sm mt-1">Clientes Atendidos</p>
            </div>
            <div class="rounded-xl hover:-translate-y-2 transition-transform p-6 text-center bg-tidewater" style="background-color: #1a3333; border: 1px solid #DAA520;">
                <i class="fa-solid fa-clock text-3xl mb-3" style="color: #DAA520;"></i>
                <p class="text-4xl font-bold text-goldenrod">5</p>
                <p class="text-champagne text-sm mt-1">Horários Disponíveis</p>
            </div>
        </div>

        {{-- Cards de acesso rápido --}}
        <h2 class="text-3xl font-bold text-goldenrod text-center mb-6 mt-4">Acesso Rápido</h2>
        <div class="grid grid-cols-3 gap-6">
            <a href="#" class="rounded-xl hover:-translate-y-2 transition-transform p-6 flex items-center gap-4 transition hover:opacity-80 cursor-pointer"
            style="background-color: #1a3333; border: 1px solid #DAA520;">
                <i class="fa-solid fa-calendar-plus text-3xl" style="color: #DAA520;"></i>
                <div>
                    <p class="text-goldenrod font-bold text-lg">Novo Agendamento</p>
                    <p class="text-champagne text-sm">Agende um novo horário</p>
                </div>
            </a>
            <a href="#" class="rounded-xl hover:-translate-y-2 transition-transform p-6 flex items-center gap-4 transition hover:opacity-80 cursor-pointer"
            style="background-color: #1a3333; border: 1px solid #DAA520;">
                <i class="fa-solid fa-calendar-days text-3xl" style="color: #DAA520;"></i>
                <div>
                    <p class="text-goldenrod font-bold text-lg">Ver Agendamentos</p>
                    <p class="text-champagne text-sm">Visualize o calendário</p>
                </div>
            </a>
            <a href="#" class="rounded-xl hover:-translate-y-2 transition-transform p-6 flex items-center gap-4 transition hover:opacity-80 cursor-pointer"
            style="background-color: #1a3333; border: 1px solid #DAA520;">
                <i class="fa-solid fa-scissors text-3xl" style="color: #DAA520;"></i>
                <div>
                    <p class="text-goldenrod font-bold text-lg">Serviços</p>
                    <p class="text-champagne text-sm">Gerencie seus serviços</p>
                </div>
            </a>
        </div>

    </div>


</x-layouts.main-layout>
