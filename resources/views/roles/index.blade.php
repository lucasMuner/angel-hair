<x-layouts.main-layout title="Funções" active="role">

   <h4 class="text-4xl font-bold font-bodoni text-goldenrod mt-4 ml-4">Funções</h4>

   <div class="mt-4 mx-4 p-6">
       <p class="text-champagne">Aqui você pode visualizar as funções do seu sistema.</p>
   </div>

    {{-- Adicionar botão com livewire --}}
   <div class="mx-4 mb-8 flex items-center justify-between">
        <div class="mx-4 w-1/2" x-data="{ search: '' }">
            <input
                type="text"
                x-model="search"
                x-on:input.debounce.400ms="$dispatch('search-roles', { search: $event.target.value })"
                placeholder="Buscar função..."
                class="w-full px-4 py-2 rounded-lg bg-noir-card border border-gold-soft text-champagne focus:border-goldenrod outline-none"
            >
        </div>
        <button type="button"
            x-data
            x-on:click="$dispatch('open-role-modal')"
            class="font-bold cursor-pointer bg-goldenrod text-white px-4 py-2 rounded-md hover:bg-goldenrod-dark transition">
            <i class="fa-solid fa-plus"></i> Adicionar Função
        </button>
    </div>

   <livewire:role.roles-list />

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
    >
        <livewire:role.role-modal />
    </div>
</x-layouts.main-layout>
