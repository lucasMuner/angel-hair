<x-layouts.modal-form modalTitle="Função" :isEditing="$isEditing" modalEvent="open-role-modal">
    <div class="mb-4">
        <x-ui.input-field
            label="Nome"
            id="name"
            name="name"
            wire:model="form.name"
            placeholder="Digite o nome da função"
        />
    </div>

    <div class="mb-4">
        <x-ui.input-field
            label="Descrição"
            id="description"
            name="description"
            wire:model="form.description"
            placeholder="Digite a descrição da função"
        />
    </div>

    <div class="mb-4">
        <x-ui.select-multiple-field
            label="Módulos"
            :options="$this->optionsModules"
            id="modules"
            name="modules"
            wireModel="form.modules"
        />
    </div>
</x-layouts.modal-form>
