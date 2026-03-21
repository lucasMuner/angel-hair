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

   <div class="grid grid-cols-4 md:grid-cols-4 lg:grid-cols-4 gap-6 mx-4 mb-8">
        <x-services-card service="Corte de Cabelo" description="Corte de cabelo profissional" price="50.00" />
        <x-services-card service="Pintura de Cabelo" description="Pintura de cabelo com produtos de qualidade" price="80.00" />
        <x-services-card service="Tratamento Capilar" description="Tratamento capilar para restaurar a saúde dos fios" price="100.00" />
        <x-services-card service="Design de Sobrancelha" description="Design de sobrancelha para realçar o rosto" price="30.00" />
    </div>

    <livewire:service-modal />

</x-layouts.main-layout>
