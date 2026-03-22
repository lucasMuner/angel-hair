<div
    x-data="{ show: @entangle('showModal') }"
    x-on:open-client-modal.window="show = true"
>
    <div
        x-show="show"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-black/50 flex items-center justify-center z-50"
        style="display: none;"
    >
        <div
            x-show="show"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-8"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 translate-y-8"
            class="rounded-lg w-full max-w-md p-6 bg-[#2F4F4F] border border-[#DAA520]"
        >
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-bold text-goldenrod font-bodoni text-gray-800">
                    {{ $isEditing ? 'Editar Funcionário' : 'Adicionar Funcionário' }}
                </h3>
                <button @click="$wire.closeModal()" class="cursor-pointer text-gray-500 hover:text-gray-700">
                    <i class="fa-solid fa-times text-xl"></i>
                </button>
            </div>

            <form  wire:submit.prevent="save">
                <div class="mb-4">
                    <x-input-field label="Nome" id="name" name="name" wire:model="name" placeholder="Digite o nome do cliente" />
                </div>

                <div class="mb-4">
                    <x-input-field label="Email" id="email" name="email" type="email" wire:model="email" placeholder="Digite o email do cliente" />
                </div>

                <div class="mb-4">
                    <x-input-field label="Telefone" id="phone" name="phone" wire:model="phone" placeholder="Digite o telefone do cliente" />
                </div>

                <div class="flex justify-between items-center space-x-2">
                    @if($isEditing)
                        <button
                            type="button"
                            @click="
                                Swal.fire({
                                    title: 'Tem certeza?',
                                    text: 'Essa ação não pode ser desfeita!',
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonColor: '#DAA520',
                                    cancelButtonColor: '#d33',
                                    confirmButtonText: 'Sim, excluir!',
                                    cancelButtonText: 'Cancelar'
                                }).then((result) => {
                                        if (result.isConfirmed) {
                                            $wire.delete();
                                        }
                                });
                            "
                            class="cursor-pointer px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition"
                        >
                            <i class="fa-solid fa-trash"></i> Excluir
                        </button>
                    @endif

                    <div class="flex-1"></div>

                    <div class="flex space-x-2">
                        <button
                            type="button"
                            @click="$wire.closeModal()"
                            class="cursor-pointer px-4 py-2 bg-gray-600 text-champagne rounded-md hover:bg-gray-700 transition"
                        >
                            Cancelar
                        </button>
                        <button
                            type="submit"
                            class="cursor-pointer px-4 py-2 bg-goldenrod text-white rounded-md hover:bg-goldenrod-dark transition"
                            wire:loading.attr="disabled"
                        >
                            <span wire:loading.remove>
                                {{ $isEditing ? 'Atualizar' : 'Salvar' }}
                            </span>
                            <span wire:loading>
                                <i class="fa-solid fa-spinner fa-spin"></i>
                                {{ $isEditing ? 'Atualizando...' : 'Salvando...' }}
                            </span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
