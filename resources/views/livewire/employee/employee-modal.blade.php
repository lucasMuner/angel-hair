<x-layouts.modal-form modalTitle="Funcionário" :isEditing="$isEditing" modalEvent="open-employee-modal">
    <div class="mb-4">
        <x-ui.input-field
            label="Nome"
            id="name"
            name="name"
            wire:model="form.name"
            placeholder="Digite o nome do funcionário"
        />
    </div>

    <div class="mb-4">
        <x-ui.input-field
            label="Email"
            id="email"
            name="email"
            type="email"
            wire:model="form.email"
            placeholder="Digite o email do funcionário"
        />
    </div>

    <div class="mb-4">
        <x-ui.input-field
            label="Telefone"
            id="phone"
            x-mask="(99) 99999-9999"
            name="phone"
            placeholder="(00) 00000-0000"
            wire:model="form.phone"
        />
    </div>
</x-layouts.modal-form>
