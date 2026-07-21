<x-layouts.modal-form modalTitle="Funcionário" :isEditing="$isEditing" modalEvent="open-employee-modal">
    <div class="mb-4">
        <x-ui.select-field
            label="Usuário"
            :options="$this->optionsUsers"
            id="userId"
            name="userId"
            wireModel="form.userId"
            wire:model.live="form.userId"
            placeholder="Selecione o usuário"
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

    <div class="mb-4">
        <x-ui.select-multiple-field
            label="Serviços"
            :options="$this->optionsServices"
            id="services"
            name="services"
            wireModel="form.services"
        />
    </div>
</x-layouts.modal-form>
