<x-layouts.main-layout title="Serviços" active="services">

   <h4 class="text-4xl font-bold font-bodoni text-goldenrod mt-4 ml-4">Serviços</h4>

   <div class="mt-4 mx-4 p-6">
       <p class="text-champagne">Aqui você pode visualizar e gerenciar todos os seus serviços. Use os filtros para encontrar rapidamente o que precisa.</p>
   </div>

    <div class="mx-4 mb-8 flex items-center justify-end">
        <button type="button"
            x-data
            x-on:click="$dispatch('open-service-modal')"
            class="font-bold cursor-pointer bg-goldenrod text-white px-4 py-2 rounded-md hover:bg-goldenrod-dark transition">
            <i class="fa-solid fa-plus"></i> Adicionar Serviço
        </button>
    </div>

    <livewire:services-list />

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
        <livewire:service-modal />
    </div>

</x-layouts.main-layout>
