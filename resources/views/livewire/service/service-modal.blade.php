<x-layouts.modal-form modalTitle="Serviço" :isEditing="$isEditing" modalEvent="open-service-modal">
    <div class="mb-4">
        <x-ui.input-field
            label="Nome"
            id="name"
            name="name"
            wire:model="form.name"
            placeholder="Digite o nome do serviço"
        />
    </div>

    <div class="mb-4">
        <x-ui.input-field
            label="Descrição"
            id="description"
            wire:model="form.description"
            name="description"
            placeholder="Digite a descrição do serviço"
        />
    </div>

    <div class="mb-4">
        <x-ui.input-field
            label="Preço"
            id="price"
            name="price"
            wire:model="form.price"
            type="number"
            step="0.01"
            placeholder="Digite o preço do serviço"
        />
    </div>

    <div class="mb-4">
        <x-ui.select-field
            label="Duração"
            :options="$this->optionsDurations"
            id="duration"
            name="duration"
            wireModel="form.duration"
            wire:model.live="form.duration"
            placeholder="Selecione a duração do serviço"
        />
    </div>
</x-layouts.modal-form>
