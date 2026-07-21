<x-layouts.modal-form modalTitle="Cliente" :isEditing="$isEditing" modalEvent="open-client-modal">
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
</x-layouts.modal-form>
