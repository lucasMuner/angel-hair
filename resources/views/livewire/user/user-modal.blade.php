<x-layouts.modal-form modalTitle="Usuário" :isEditing="$isEditing" modalEvent="open-user-modal">

    <div class="mb-4">
        <x-ui.input-field
            label="Usuário"
            id="username"
            name="username"
            wire:model="form.username"
            placeholder="Digite o nome de usuário"
        />
    </div>

    <div class="mb-4">
        <x-ui.input-field
            label="Nome"
            id="name"
            name="name"
            wire:model="form.name"
            placeholder="Digite o nome"
        />
    </div>

    <div class="mb-4">
        <x-ui.input-field
            label="Email"
            id="email"
            name="email"
            type="email"
            wire:model="form.email"
            placeholder="Digite o email"
        />
    </div>

    <div class="mb-4">
        <x-ui.select-field
            label="Função"
            :options="$this->optionsRoles"
            id="role_id"
            name="role_id"
            wireModel="form.role_id"
            wire:model.live="form.role_id"
            placeholder="Selecione a função"
        />
    </div>

    @if(!$isEditing)
        <div class="mb-4">
            <x-ui.input-field
                label="Senha"
                id="password"
                name="password"
                type="password"
                wire:model="form.password"
                placeholder="Digite a senha"
            />
        </div>
    @endif
</x-layouts.modal-form>
