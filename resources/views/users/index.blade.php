<x-layouts.main-layout title="Usuários" active="user">

   <h4 class="text-4xl font-bold font-bodoni text-goldenrod mt-4 ml-4">Usuários</h4>

    <div class="mx-4 mb-8 flex items-center justify-end gap-3 mt-4">
        <button type="button"
            x-data
            x-on:click="$dispatch('request-export')"
            class="font-bold cursor-pointer bg-noir-deep border border-gold-soft text-white px-4 py-2 rounded-md hover:bg-noir-muted transition">
            <i class="fa-solid fa-file-export"></i> Exportar
        </button>

        <button type="button"
            x-data
            x-on:click="$dispatch('open-user-modal')"
            class="font-bold cursor-pointer bg-goldenrod text-white px-4 py-2 rounded-md hover:bg-goldenrod-dark transition">
            <i class="fa-solid fa-plus"></i> Novo Usuário
        </button>
    </div>

    <livewire:user.users-list />

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
        <livewire:user.user-modal />
    </div>

</x-layouts.main-layout>
