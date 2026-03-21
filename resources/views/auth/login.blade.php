<x-layouts.main-layout title="Login">

    <div class="min-h-screen flex items-center justify-center relative">

        {{-- Winds --}}
        <img src="{{ asset('assets/img/asa-esquerda.png') }}"
            class="hidden lg:block absolute w-48 pointer-events-none"
            style="left: calc(50% - 380px); top: 50%; transform: translateY(-70%);">

        <img src="{{ asset('assets/img/asa-direita.png') }}"
            class="hidden lg:block absolute w-48 pointer-events-none"
            style="right: calc(50% - 380px); top: 50%; transform: translateY(-70%);">


        {{-- Form --}}
        <div class="bg-[#2F4F4F] rounded-2xl border-[#DAA520] border-2 w-full max-w-md p-8 relative z-10" style="box-shadow: 0 5px 20px rgba(0,0,0,0.7);">

            @if(session('error'))
                <div id="error-alert" class="mb-4 rounded-md text-sm text-center py-2 px-4 bg-red-950 text-red-300 border border-red-500">
                    ⚠️ {{ session('error') }}
                </div>

                <script>
                    setTimeout(() => {
                        const alert = document.getElementById('error-alert');
                        alert.style.opacity = '0';
                        setTimeout(() => alert.remove(), 500);
                    }, 3000);
                </script>
            @endif

            <div class="flex items-center justify-center gap-3 mb-6">
                <img src="{{ asset('assets/img/logo.png') }}" alt="Logo" class="w-11 h-11">
                <h2 class="text-3xl font-bold font-bodoni text-champagne">LOGIN</h2>
            </div>

            <form method="POST" action="{{ route('login.post') }}">
                @csrf
                <div class="mb-4">
                    <x-input-field label="Usuário" id="username" name="username" />
                </div>
                <div class="mb-4">
                    <x-input-field label="Senha" id="password" name="password" type="password" />
                </div>
                <div>
                    <button type="submit"
                            class="cursor-pointer w-full font-medium py-2 px-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#DAA520]"
                            style="background-color: #DAA520; color: #2F4F4F;"
                    >
                        Login
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.main-layout>
