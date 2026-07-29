<?php

namespace App\Livewire\Service;

use App\Livewire\Service\Forms\ServiceForm;
use App\Contracts\ServiceServiceInterface;
use Livewire\Attributes\{Computed, On};
use Livewire\WithFileUploads;
use App\Livewire\Base\BaseModal;

class ServiceModal extends BaseModal
{
    use WithFileUploads;

    public ServiceForm $form;

    #[On('open-service-modal')]
    public function openModal()
    {
        parent::openModal();
    }

    #[Computed]
    public function optionsDurations()
    {
        return [
            30 => '30 minutos',
            60 => '1 hora',
            90 => '1 hora e 30 minutos',
            120 => '2 horas'
        ];
    }

    #[On('edit-service')]
    public function editService($id, ServiceServiceInterface $service)
    {
        if ($found = $service->find($id)) {
            $this->entityId = $found->id;
            $this->form->fill([
                'serviceId'    => $found->id,
                'name'         => $found->name,
                'description'  => $found->description,
                'price'        => $found->price,
                'duration'     => $found->duration,
                'currentImage' => $found->image,
            ]);
            $this->isEditing = true;
            $this->showModal = true;
        }
    }

    public function save(ServiceServiceInterface $service)
    {
        try {
            $validatedData = $this->form->validate();

            // A imagem vem separada, não faz parte do array validado pro model
            $image = $this->form->image;
            unset($validatedData['image']);

            if ($this->isEditing) {
                $service->update($this->entityId, $validatedData, $image);
                $message = 'Serviço atualizado com sucesso!';
            } else {
                $service->store($validatedData, $image);
                $message = 'Serviço criado com sucesso!';
            }

            $this->notify($message, 'refreshServicesList');

        } catch (\Exception $e) {
            $this->dispatch('alert', type: 'error', message: 'Erro: ' . $e->getMessage());
        }
    }

    public function delete(ServiceServiceInterface $service)
    {
        try {
            if (!$this->isEditing || !$this->entityId) {
                throw new \Exception('Serviço não encontrado.');
            }

            $service->delete($this->entityId);
            $this->notify('Serviço deletado com sucesso!', 'refreshServicesList');

        } catch (\Exception $e) {
            $this->dispatch('alert', type: 'error', message: 'Erro: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.service.service-modal');
    }
}
