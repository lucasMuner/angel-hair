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
    <nav class="flex flex-col gap-2 overflow-y-auto">
        @foreach(auth()->user()->role->modules->sortBy('order') as $module)
            @if($module->activated && $module->pivot->can_view)
                <x-ui.side-bar-item
                    href="{{ route($module->route_name) }}"
                    :active="$active"
                    module="{{ $module->slug }}"
                    name="{{ $module->name }}"
                    icon="{{ $module->icon }}"
                />
            @endif
        @endforeach
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
