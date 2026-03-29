<x-layouts.modal-form modalTitle="Agendamento" modalWidth="max-w-2xl" :isEditing="$isEditing" modalEvent="open-appointment-modal">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
        <div>
            <x-select-field
                label="Funcionário"
                :options="$this->optionsEmployees"
                id="employee_id"
                name="employee_id"
                wire:model="form.employee_id"
                placeholder="Selecione o funcionário"
            />
        </div>

        <div>
            <x-select-field
                label="Cliente"
                :options="$this->optionsClients"
                id="client_id"
                name="client_id"
                wire:model="form.client_id"
                placeholder="Selecione o cliente"
            />
        </div>
    </div>
    <div class="mb-4">
        <x-select-field
            label="Serviço"
            :options="$this->optionsServices"
            id="service_id"
            name="service_id"
            wire:model="form.service_id"
            placeholder="Selecione o serviço"
        />
    </div>
</x-layouts.modal-form>
