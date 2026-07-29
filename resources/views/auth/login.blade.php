<x-layouts.main-layout title="Login">

    <div class="min-h-screen flex items-center justify-center relative bg-noir-deep overflow-y-auto px-4 py-10">

        <x-ui.corner-deco />

        <div class="bg-noir-surface rounded-2xl border-2 border-goldenrod w-full max-w-md p-8 relative z-20 shadow-[0_8px_32px_rgba(0,0,0,0.8)]">

            @if ($errors->any())
                <div id="error-alert" class="mb-4 rounded-md text-sm text-center py-2 px-4 bg-red-950 text-red-300 border border-red-500">
                    @foreach ($errors->all() as $error)
                        <p>⚠️ {{ $error }}</p>
                    @endforeach
                </div>
                <script>
                    setTimeout(() => {
                        const alert = document.getElementById('error-alert');
                        alert.style.transition = 'opacity 0.5s';
                        alert.style.opacity = '0';
                        setTimeout(() => alert.remove(), 500);
                    }, 3000);
                </script>
            @endif

            <div class="flex items-center justify-center gap-3 mb-6">
                <img src="{{ asset('assets/img/logo.png') }}" alt="Logo" class="w-11 h-11">
                <h2 class="text-3xl font-bold font-bodoni text-goldenrod">Angel Hair</h2>
            </div>

            {{-- Divisor --}}
            <div class="flex items-center justify-center gap-3 mb-6">
                <div class="h-px w-16 bg-goldenrod opacity-40"></div>
                <div class="w-1.5 h-1.5 rounded-full bg-goldenrod opacity-60"></div>
                <div class="h-px w-16 bg-goldenrod opacity-40"></div>
            </div>

            <form method="POST" action="{{ route('login.post') }}">
                @csrf
                <div class="mb-4">
                    <x-ui.input-field label="Usuário" id="username" name="username" placeholder="Seu nome de usuário" />
                </div>
                <div class="mb-6">
                    <x-ui.input-field label="Senha" id="password" name="password" type="password" placeholder="Digite sua senha" />
                </div>
                <div class="mb-6 flex items-center">
                    <x-ui.checkbox-field label="Lembrar de mim" id="remember" name="remember" value="1" />
                </div>

                <div class="mb-6">
                    <p class="text-champagne text-sm text-center">
                        Não tem uma conta? <a href="{{ route('register') }}" class="text-goldenrod hover:text-gold-deep transition">Cadastre-se</a>
                    </p>
                </div>

                <button type="submit"
                    class="cursor-pointer w-full font-medium py-2 px-4 rounded-lg bg-goldenrod text-noir-deep hover:bg-gold-deep focus:outline-none focus:ring-2 focus:ring-goldenrod transition"
                >
                    Entrar
                </button>
            </form>
        </div>
    </div>

</x-layouts.main-layout>
