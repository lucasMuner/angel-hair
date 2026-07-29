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

    <div class="mb-4">
        <label for="image" class="block text-sm font-medium text-champagne mb-2">Foto do Serviço</label>

        <input
            type="file"
            id="image"
            wire:model="form.image"
            accept="image/*"
            class="block w-full text-sm text-muted file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-goldenrod file:text-noir-deep file:font-medium"
        >

        {{-- Loading enquanto o upload acontece --}}
        <div wire:loading wire:target="form.image" class="text-sm text-muted mt-2">
            Enviando imagem...
        </div>

        {{-- Preview da imagem nova selecionada --}}
        @if ($form->image)
            <img src="{{ $form->image->temporaryUrl() }}" class="mt-3 w-32 h-32 object-cover rounded-lg border border-gold-soft">

        {{-- Ou preview da imagem já salva, se estiver editando e não trocou --}}
        @elseif ($form->currentImage)
            <img src="{{ Storage::url($form->currentImage) }}" class="mt-3 w-32 h-32 object-cover rounded-lg border border-gold-soft">
        @endif

        @error('form.image')
            <span class="text-red-400 text-sm mt-1 block">{{ $message }}</span>
        @enderror
    </div>
</x-layouts.modal-form>
