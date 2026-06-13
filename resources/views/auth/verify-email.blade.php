<x-layouts.main-layout title="Register">

    <div class="min-h-screen flex items-center justify-center relative bg-noir-deep overflow-hidden">

        <x-ui.corner-deco />

        <div class="bg-noir-surface rounded-2xl border-2 border-goldenrod w-full max-w-md p-8 relative z-20 shadow-[0_8px_32px_rgba(0,0,0,0.8)]">

            {{-- Divisor --}}
            <div class="flex items-center justify-center gap-3 mb-6">
                <div class="h-px w-16 bg-goldenrod opacity-40"></div>
                <div class="w-1.5 h-1.5 rounded-full bg-goldenrod opacity-60"></div>
                <div class="h-px w-16 bg-goldenrod opacity-40"></div>
            </div>

            <div class="mb-6">
                <h2 class="text-2xl font-bold text-center text-goldenrod mb-4">Verifique seu email</h2>
                <p class="text-champagne text-sm text-center">
                    Um link de verificação foi enviado para o seu email. Por favor, verifique sua caixa de entrada e clique no link para ativar sua conta.
                </p>
            </div>
        </div>
    </div>

</x-layouts.main-layout>
