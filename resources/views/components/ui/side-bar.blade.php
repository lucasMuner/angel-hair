@props([
    'active' => ''
])

<aside
    :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
    class="fixed lg:relative z-40 h-screen w-[280px] flex-shrink-0 flex flex-col py-8 px-4 transition-transform duration-300 ease-in-out bg-noir-deep border-r-4 border-r-goldenrod shadow-[4px_0_24px_rgba(0,0,0,0.8)]"
>

    {{-- Logo --}}
    <div class="flex items-center justify-center gap-2 mb-8 mt-4">
        <img src="{{ asset('assets/img/logo.png') }}" alt="Logo" class="w-10 h-10">
        <span class="text-xl font-bold text-goldenrod font-cinzel">
            Angel Hair
        </span>
    </div>

    {{-- Menu --}}
    <nav class="flex flex-col gap-2">
        <x-ui.side-bar-item href="{{ route('home') }}" :active="$active" module="home" name="Início" icon="fa-solid fa-house"/>

        <x-ui.side-bar-item href="{{ route('clients') }}" :active="$active" module="clients" name="Clientes" icon="fa-solid fa-users"/>

        <x-ui.side-bar-item href="{{ route('employees') }}" :active="$active" module="employees" name="Funcionários" icon="fa-solid fa-briefcase"/>

        <x-ui.side-bar-item href="{{ route('services') }}" :active="$active" module="services" name="Serviços" icon="fa-solid fa-scissors"/>

        <x-ui.side-bar-item href="{{ route('appointments') }}" :active="$active" module="appointments" name="Agendamentos" icon="fa-solid fa-calendar-check"/>

        <x-ui.side-bar-item href="{{ route('roles') }}" :active="$active" module="roles" name="Funções" icon="fa-solid fa-user-tag"/>
    </nav>

    {{-- Footer da sidebar --}}
    <div class="mt-auto">
        <div>
            <a href="#"
               class="w-full flex items-center text-champagne text-lg gap-3 px-4 py-2 rounded-lg font-medium transition hover:bg-red-10">
                <i class="fa-solid fa-user"></i> {{ auth()->user()->name ?? ' - ' }}
            </a>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                    class="cursor-pointer w-full flex items-center text-[#ff6b6b] text-lg gap-3 px-4 py-2 rounded-lg font-medium transition hover:bg-red-10">
                <i class="fa-solid fa-right-from-bracket"></i> Sair
            </button>
        </form>
    </div>
</aside>
