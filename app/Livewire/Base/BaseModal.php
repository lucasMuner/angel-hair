<?php

namespace App\Livewire\Base;

use Livewire\Component;

abstract class BaseModal extends Component
{
    public $showModal = false;
    public $entityId = null;
    public $userId = null;
    public $isEditing = false;

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
        $this->reset(['entityId', 'userId', 'isEditing']);
        $this->form->reset();
    }

    protected function notify(string $message, string $refreshEvent)
    {
        $this->dispatch('alert', type: 'success', message: $message);
        $this->dispatch($refreshEvent);
        $this->closeModal();
    }
}
