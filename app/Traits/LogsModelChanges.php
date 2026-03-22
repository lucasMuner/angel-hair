<?php

namespace App\Traits;

use Illuminate\Support\Facades\Log;

trait LogsModelChanges
{
    public function saveWithLog(): bool
    {
        $isNew = !$this->exists;
        $action = $isNew ? 'Creating' : 'Updating';

        Log::info("{$action} model: " . get_class($this), [
            'data' => $this->toArray(),
            'user_id' => session()->get('user_id'),
            'ip' => request()->ip(),
        ]);

        $saved = $this->save();

        if ($saved) {
            Log::info('Model saved successfully: ' . get_class($this), [
                'id' => $this->id,
                'action' => $isNew ? 'created' : 'updated',
            ]);
        } else {
            Log::error('Failed to save model: ' . get_class($this));
        }

        return $saved;
    }

    public function deleteWithLog(): bool
    {
        Log::info('Deleting model: ' . get_class($this), [
            'id' => $this->id,
            'data' => $this->toArray(),
            'user_id' => session()->get('user_id'),
            'ip' => request()->ip(),
        ]);

        $deleted = $this->delete();

        if ($deleted) {
            Log::info('Model deleted successfully: ' . get_class($this), [
                'id' => $this->id,
            ]);
        } else {
            Log::error('Failed to delete model: ' . get_class($this), [
                'id' => $this->id,
            ]);
        }

        return $deleted;
    }
}
