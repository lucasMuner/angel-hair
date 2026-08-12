<x-layouts.main-layout title="Clientes" active="client">

   <h4 class="text-4xl font-bold font-bodoni text-goldenrod mt-4 ml-4">Clientes</h4>

   <div class="mt-4 mx-4 p-6">
       <p class="text-champagne">Aqui você pode visualizar e gerenciar todos os seus clientes. Use os filtros para encontrar rapidamente o que precisa.</p>
   </div>

    <div class="mx-4 mb-8 flex items-center justify-between">
        <div class="mx-4 w-1/2" x-data="{ search: '' }">
            <input
                type="text"
                x-model="search"
                x-on:input.debounce.400ms="$dispatch('search-clients', { search: $event.target.value })"
                placeholder="Buscar clientes..."
                class="w-full px-4 py-2 rounded-lg bg-noir-card border border-gold-soft text-champagne focus:border-goldenrod outline-none"
            >
        </div>
        <button type="button"
            x-data
            x-on:click="$dispatch('open-client-modal')"
            class="font-bold cursor-pointer bg-goldenrod text-white px-4 py-2 rounded-md hover:bg-goldenrod-dark transition">
            <i class="fa-solid fa-plus"></i> Adicionar Cliente
        </button>
    </div>

    <livewire:client.clients-list />

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
        <livewire:client.client-modal />
    </div>

</x-layouts.main-layout>
