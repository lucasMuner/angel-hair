<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Services\ServiceService;
use Illuminate\Support\Facades\Log;

class ServiceModal extends Component
{
    public $showModal = false;
    public $serviceId = null;
    public $name, $description, $price;
    public $isEditing = false;

    protected ServiceService $serviceService;

    public function boot(ServiceService $serviceService)
    {
        $this->serviceService = $serviceService;
    }

    #[On('edit-service')]
    public function editService($id)
    {
        $service = $this->serviceService->find($id);

        if ($service) {
            $this->serviceId = $service->id;
            $this->name = $service->name;
            $this->description = $service->description;
            $this->price = $service->price;
            $this->isEditing = true;
            $this->showModal = true;
        }
    }

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
        ];
    }

    protected function messages()
    {
        return [
            'name.required' => 'O nome é obrigatório.',
            'description.string' => 'A descrição deve ser um texto.',
            'price.required' => 'O preço é obrigatório.',
            'price.numeric' => 'O preço deve ser um número.',
            'price.min' => 'O preço deve ser um valor positivo.'
        ];
    }

    public function save()
    {
        $this->validate();

        try {
            $data = [
                'name' => $this->name,
                'description' => $this->description,
                'price' => $this->price,
            ];

            if ($this->isEditing) {
                $this->serviceService->update($this->serviceId, $data);
                $message = 'Serviço atualizado com sucesso!';
            } else {
                $this->serviceService->store($data);
                $message = 'Serviço criado com sucesso!';
            }

            $this->dispatch('alert', type: 'success', message: $message);
            $this->dispatch('refreshServicesList');
            $this->closeModal();

        } catch (\Exception $e) {
            $this->dispatch('alert', type: 'error', message: 'Erro: ' . $e->getMessage());
        }
    }

    public function delete()
    {
        try {
            if (!$this->isEditing || !$this->serviceId) {
                throw new \Exception('Serviço não encontrado.');
            }

            $this->serviceService->delete($this->serviceId);

            $this->dispatch('alert', type: 'success', message: 'Serviço excluído com sucesso!');
            $this->dispatch('refreshServicesList');
            $this->closeModal();

        } catch (\Exception $e) {
            $this->dispatch('alert', type: 'error', message: 'Erro: ' . $e->getMessage());
        }
    }

    public function openModal()
    {
        $this->isEditing = false;
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->cleanFields();
    }

    public function cleanFields()
    {
        $this->reset();
    }

    public function render()
    {
        return view('livewire.service-modal');
    }
}
