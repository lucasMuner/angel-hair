<x-layouts.modal-form modalTitle="Agendamento" modalWidth="max-w-2xl" :isEditing="$isEditing" modalEvent="open-appointment-modal">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
        <div>
            <x-ui.select-field
                label="Funcionário"
                :options="$this->optionsEmployees"
                id="employee_id"
                name="employee_id"
                wire:model.live="form.employee_id"
                placeholder="Selecione o funcionário"
            />
        </div>

        <div>
            <x-ui.select-field
                label="Cliente"
                :options="$this->optionsClients"
                id="client_id"
                name="client_id"
                wire:model.live="form.client_id"
                placeholder="Selecione o cliente"
            />
        </div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
        @if($form->employee_id && $form->client_id)
            <div wire:transition class="mb-4">
                <x-ui.select-field
                    label="Serviço"
                    :options="$this->optionsServices"
                    id="service_id"
                    name="service_id"
                    wire:model.live="form.service_id"
                    placeholder="Selecione o serviço"
                />
            </div>
        @endif
        @if($form->service_id)
            <div wire:transition class="mb-4">
                <x-ui.input-field
                    label="Data"
                    id="scheduled_at"
                    name="scheduled_at"
                    type="date"
                    wire:model.live="form.scheduled_at"
                />
            </div>
        @endif
    </div>

    <div class="grid grid-cols-1 gap-4 mb-4">
        @if($form->availableTimes)
            <div class="flex flex-wrap gap-1 mb-4">
                @foreach ($form->availableTimes as $item)
                    <input
                        type="radio"
                        id="time_{{ $item }}"
                        value="{{ $item }}"
                        wire:model.live="form.scheduled_time"
                        class="hidden peer"
                    />
                    <label for="time_{{ $item }}" class="cursor-pointer px-4 py-2 rounded-full transition block
                        {{ $form->scheduled_time === $item ? 'bg-goldenrod text-white' : 'bg-gray-700 text-champagne hover:bg-gray-600' }}">
                        {{ \Carbon\Carbon::parse($item)->format('H:i') }}
                    </label>
                @endforeach
            </div>
        @endif
    </div>

    @if($form->service_id && $form->scheduled_at)
        <button
            type="button"
            class="cursor-pointer px-4 py-2 bg-goldenrod text-white rounded-md hover:bg-goldenrod-dark transition"
            wire:click="$dispatch('search-availability')"
        >Procurar Disponibilidade</button>
    @endif
</x-layouts.modal-form>
