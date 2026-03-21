<x-layouts.main-layout title="Clientes" active="clients">

   <h4 class="text-4xl font-bold font-bodoni text-goldenrod mt-4 ml-4">Clientes</h4>

   <div class="mt-4 mx-4 p-6">
       <p class="text-champagne">Aqui você pode visualizar e gerenciar todos os seus clientes. Use os filtros para encontrar rapidamente o que precisa.</p>
   </div>

    <div class="mx-4 mb-8 flex items-center justify-end">
        <button type="button"
            x-data
            x-on:click="$dispatch('open-client-modal')"
            class="font-bold cursor-pointer bg-goldenrod text-white px-4 py-2 rounded-md hover:bg-goldenrod-dark transition">
            <i class="fa-solid fa-plus"></i> Adicionar Cliente
        </button>
    </div>

   <div class="grid grid-cols-4 md:grid-cols-4 lg:grid-cols-4 gap-6 mx-4 mb-8">
        <x-clients-card client="Maria Silva" email="maria.silva@example.com" phone="1234567890" />
        <x-clients-card client="João Santos" email="joao.santos@example.com" phone="0987654321" />
        <x-clients-card client="Ana Costa" email="ana.costa@example.com" phone="1122334455" />
        <x-clients-card client="Carlos Oliveira" email="carlos.oliveira@example.com" phone="5544332211" />
    </div>

    <livewire:client-modal />

</x-layouts.main-layout>
