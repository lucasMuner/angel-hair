@props([
    'active' => ''
])

<aside class="h-screen w-[280px] flex flex-col py-8 px-4"
       style="background-color: #1a3333; border-right: 6px solid #DAA520; box-shadow: 0 5px 20px rgba(0,0,0,0.7);">

    {{-- Logo --}}
    <div class="flex items-center justify-center gap-2 mb-8 mt-4">
        <img src="{{ asset('assets/img/logo.png') }}" alt="Logo" class="w-10 h-10">
        <span class="text-xl font-bold" style="color: #DAA520; font-family: 'Cinzel Decorative', serif;">
            Angel Hair
        </span>
    </div>

    {{-- Menu --}}
    <nav class="flex flex-col gap-2">
        <a href="{{ route('home') }}"
           class="flex items-center gap-3 px-4 py-2 rounded-lg text-lg font-medium transition"
           style="color: {{ $active === 'home' ? '#DAA520' : '#ccc' }}; background-color: {{ $active === 'home' ? 'rgba(218,165,32,0.1)' : 'transparent' }};">
            <i class="fa-solid fa-house"></i> Início
        </a>
        <a href="{{ route('clients') }}"
           class="flex items-center gap-3 px-4 py-2 rounded-lg text-lg font-medium transition"
           style="color: {{ $active === 'clients' ? '#DAA520' : '#ccc' }}; background-color: {{ $active === 'clients' ? 'rgba(218,165,32,0.1)' : 'transparent' }};">
            <i class="fa-solid fa-users"></i>Clientes
        </a>
        <a href="{{ route('employees') }}"
           class="flex items-center gap-3 px-4 py-2 rounded-lg text-lg font-medium transition"
           style="color: {{ $active === 'employees' ? '#DAA520' : '#ccc' }}; background-color: {{ $active === 'employees' ? 'rgba(218,165,32,0.1)' : 'transparent' }};">
            <i class="fa-solid fa-briefcase"></i> Funcionários
        </a>
        <a href="{{ route('services') }}"
           class="flex items-center gap-3 px-4 py-2 rounded-lg text-lg font-medium transition"
           style="color: {{ $active === 'services' ? '#DAA520' : '#ccc' }}; background-color: {{ $active === 'services' ? 'rgba(218,165,32,0.1)' : 'transparent' }};">
            <i class="fa-solid fa-scissors"></i> Serviços
        </a>
        <a href="{{ route('appointments') }}"
           class="flex items-center gap-3 px-4 py-2 rounded-lg text-lg font-medium transition"
           style="color: {{ $active === 'appointments' ? '#DAA520' : '#ccc' }}; background-color: {{ $active === 'appointments' ? 'rgba(218,165,32,0.1)' : 'transparent' }};">
            <i class="fa-solid fa-calendar-check"></i> Agendamentos
        </a>
    </nav>

    {{-- Footer da sidebar --}}
    <div class="mt-auto">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                    class="cursor-pointer w-full flex items-center text-lg gap-3 px-4 py-2 rounded-lg font-medium transition"
                    style="color: #ff6b6b;">
                <i class="fa-solid fa-right-from-bracket"></i> Sair
            </button>
        </form>
    </div>
</aside>
