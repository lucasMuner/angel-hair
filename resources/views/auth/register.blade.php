<x-layouts.main-layout title="Register">

    <div class="min-h-screen flex items-start sm:items-center justify-center relative bg-noir-deep overflow-y-auto px-4 py-10">

        <x-ui.corner-deco />

        <div class="bg-noir-surface rounded-2xl border-2 border-goldenrod w-full max-w-md p-6 sm:p-8 relative z-20 shadow-[0_8px_32px_rgba(0,0,0,0.8)]">

            {{-- Divisor --}}
            <div class="flex items-center justify-center gap-3 mb-6">
                <div class="h-px w-16 bg-goldenrod opacity-40"></div>
                <div class="w-1.5 h-1.5 rounded-full bg-goldenrod opacity-60"></div>
                <div class="h-px w-16 bg-goldenrod opacity-40"></div>
            </div>

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

            <form method="POST" action="{{ route('register-store') }}">
                @csrf
                <div class="mb-4">
                    <x-ui.input-field label="Usuário" id="username" name="username" placeholder="Seu nome de usuário" />
                </div>

                <div class="mb-4">
                    <x-ui.input-field label="Nome" id="name" name="name" placeholder="Seu nome completo" />
                </div>

                <div class="mb-4">
                    <x-ui.input-field label="Email" id="email" name="email" type="email" placeholder="seu@email.com" />
                </div>

                <div class="mb-4">
                    <x-ui.input-field label="Telefone" id="phone" x-mask="(99) 99999-9999" name="phone" placeholder="(00) 00000-0000"/>
                </div>

                <div class="mb-4">
                    <x-ui.input-field label="Data de Nascimento" id="birth_date" name="birth_date" type="date" />
                </div>

                <div class="mb-6">
                    <x-ui.input-field label="Senha" id="password" name="password" type="password" placeholder="Digite sua senha"/>
                </div>

                 <div class="mb-6">
                    <p class="text-champagne text-sm text-center">
                        Já tem uma conta? <a href="{{ route('login') }}" class="text-goldenrod hover:text-gold-deep transition">Faça login</a>
                    </p>
                </div>

                <button type="submit"
                    class="cursor-pointer w-full font-medium py-2 px-4 rounded-lg bg-goldenrod text-noir-deep hover:bg-gold-deep focus:outline-none focus:ring-2 focus:ring-goldenrod transition"
                >
                    Registrar
                </button>
            </form>
        </div>
    </div>

</x-layouts.main-layout>
