<div
    x-data="{ show: false }"
    x-on:open-employee-modal.window="show = true"
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
                <h3 class="text-xl font-bold text-goldenrod font-bodoni text-gray-800">Adicionar Funcionário</h3>
                <button @click="show = false" class="text-gray-500 hover:text-gray-700">
                    <i class="fa-solid fa-times text-xl"></i>
                </button>
            </div>

            <form>
                <div class="mb-4">
                    <x-input-field label="Nome" id="name" name="name" placeholder="Digite o nome do funcionário" />
                </div>

                <div class="mb-4">
                    <x-input-field label="Email" id="email" name="email" type="email" placeholder="Digite o email do funcionário" />
                </div>

                <div class="mb-4">
                    <x-input-field label="Telefone" id="phone" name="phone" placeholder="Digite o telefone do funcionário" />
                </div>

                <div class="flex justify-end space-x-2">
                    <button type="button"
                            @click="show = false"
                            class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 transition">
                        Cancelar
                    </button>
                    <button type="submit"
                            class="px-4 py-2 bg-goldenrod text-white rounded-md hover:bg-goldenrod-dark transition">
                        Salvar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
