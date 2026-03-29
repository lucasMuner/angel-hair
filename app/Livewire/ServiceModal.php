<?php

namespace App\Livewire;

use App\Livewire\Forms\ServiceForm;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Services\ServiceService;
use Illuminate\Support\Facades\Log;

class ServiceModal extends Component
{

    public ServiceForm $form;
    public $showModal = false;
    public $serviceId = null;
    public $isEditing = false;

    #[On('edit-service')]
    public function editService($id, ServiceService $service)
    {
        if ($service = $service->find($id)) {
            $this->serviceId = $service->id;
            $this->form->fill([
                'serviceId' => $service->id,
                'name' => $service->name,
                'description' => $service->description,
                'price' => $service->price,
            ]);
            $this->isEditing = true;
            $this->showModal = true;
        }
    }

    public function save(ServiceService $service)
    {
        try {
            $validatedData = $this->form->validate();

            if ($this->isEditing) {
                $service->update($this->serviceId, $validatedData);
                $message = 'Serviço atualizado com sucesso!';
            } else {
                $service->store($validatedData);
                $message = 'Serviço criado com sucesso!';
            }

            $this->notify($message);

        } catch (\Exception $e) {
            $this->dispatch('alert', type: 'error', message: 'Erro: ' . $e->getMessage());
        }
    }

    public function delete(ServiceService $service)
    {
        try {
            if (!$this->isEditing || !$this->serviceId) throw new \Exception('Serviço não encontrado.');

            $service->delete($this->serviceId);

            $this->notify('Serviço deletado com sucesso!');

        } catch (\Exception $e) {
            $this->dispatch('alert', type: 'error', message: 'Erro: ' . $e->getMessage());
        }
    }

    public function notify($message)
    {
        $this->dispatch('alert', type: 'success', message: $message);
        $this->dispatch('refreshServicesList');
        $this->closeModal();
    }

    public function openModal()
    {
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->cleanFields();
        $this->showModal = false;
    }

    public function cleanFields()
    {
        $this->reset(['serviceId', 'isEditing']);
        $this->form->reset();
    }

    public function render()
    {
        return view('livewire.service-modal');
    }
}
