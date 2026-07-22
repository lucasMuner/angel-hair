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

    <div class="mb-4">
        <x-ui.input-field
            label="Aniversário"
            type="date"
            id="birth_date"
            name="birth_date"
            wire:model="form.birth_date"
        />
    </div>

    <div class="mb-4">
        <x-ui.input-field
            label="Sobre"
            id="notes"
            name="notes"
            placeholder="Informações adicionais sobre o cliente"
            wire:model="form.notes"
        />
    </div>
</x-layouts.modal-form>
