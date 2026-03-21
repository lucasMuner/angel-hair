<x-layouts.main-layout title="Agendamentos" active="appointments">

   <h4 class="text-4xl font-bold font-bodoni text-goldenrod mt-4 ml-4">Agendamentos</h4>

   <div class="mt-4 mx-4 p-6">
       <p class="text-champagne">Aqui você pode visualizar e gerenciar todos os seus agendamentos. Use os filtros para encontrar rapidamente o que precisa.</p>
   </div>

    {{-- Adicionar botão com livewire --}}
   <div class="mx-4 mb-8 flex items-center justify-end">
        <button type="button" class="font-bold cursor-pointer bg-goldenrod text-white px-4 py-2 rounded-md hover:bg-goldenrod-dark transition">
            <i class="fa-solid fa-plus"></i> Agendar
        </button>
   </div>

   <div class="grid grid-cols-4 md:grid-cols-4 lg:grid-cols-4 gap-6 mx-4 mb-8">
         <x-appointments-card appointment="001" client="Maria Silva" date="2024-06-15" time="14:00" />
         <x-appointments-card appointment="002" client="João Santos" date="2024-06-16" time="10:00" />
         <x-appointments-card appointment="003" client="Ana Costa" date="2024-06-17" time="16:00" />
         <x-appointments-card appointment="004" client="Carlos Oliveira" date="2024-06-18" time="11:00" />
    </div>

    <livewire:employee-modal />
</x-layouts.main-layout>
