<x-layouts.modal-form modalTitle="Cliente" modalWidth="max-w-md" :isEditing="$isEditing" modalEvent="open-client-modal">
    <div class="mb-4">
        <x-input-field
            label="Nome"
            id="name"
            name="name"
            wire:model="form.name"
            placeholder="Digite o nome do cliente"
        />
    </div>

    <div class="mb-4">
        <x-input-field
            label="Email"
            id="email"
            name="email"
            type="email"
            wire:model="form.email"
            placeholder="Digite o email do cliente"
        />
    </div>

    <div class="mb-4">
        <x-input-field
            label="Telefone"
            id="phone"
            x-mask="(99) 99999-9999"
            name="phone"
            placeholder="(00) 00000-0000"
            wire:model="form.phone"
            placeholder="Digite o telefone do cliente"
        />
    </div>
</x-layouts.modal-form>
