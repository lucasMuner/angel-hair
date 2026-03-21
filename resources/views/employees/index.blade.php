<x-layouts.main-layout title="Funcionários" active="employees">

   <h4 class="text-4xl font-bold font-bodoni text-goldenrod mt-4 ml-4">Funcionários</h4>

   <div class="mt-4 mx-4 p-6">
       <p class="text-champagne">Aqui você pode visualizar e gerenciar todos os seus funcionários. Use os filtros para encontrar rapidamente o que precisa.</p>
   </div>

    {{-- Adicionar botão com livewire --}}
   <div class="mx-4 mb-8 flex items-center justify-end">
        <button type="button"
            x-data
            x-on:click="$dispatch('open-employee-modal')"
            class="font-bold cursor-pointer bg-goldenrod text-white px-4 py-2 rounded-md hover:bg-goldenrod-dark transition">
            <i class="fa-solid fa-plus"></i> Adicionar Funcionário
        </button>
   </div>

   <div class="grid grid-cols-4 md:grid-cols-4 lg:grid-cols-4 gap-6 mx-4 mb-8">
        <x-employees-card employee="Maria Silva" email="maria.silva@example.com" phone="1234567890" />
        <x-employees-card employee="João Santos" email="joao.santos@example.com" phone="0987654321" />
        <x-employees-card employee="Ana Costa" email="ana.costa@example.com" phone="1122334455" />
        <x-employees-card employee="Carlos Oliveira" email="carlos.oliveira@example.com" phone="5544332211" />
    </div>

    <livewire:employee-modal />

</x-layouts.main-layout>
