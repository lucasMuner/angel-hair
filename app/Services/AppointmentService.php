<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Models\Appointment;
use Illuminate\Support\Facades\Log;

class AppointmentService
{
    public function store(array $data): Appointment
    {
        DB::beginTransaction();
        try {
            // Create Appointment
            $appointment = new Appointment();
            $appointment->employee_id = $data['employee_id'];
            $appointment->client_id = $data['client_id'];
            $appointment->service_id = $data['service_id'];
            $appointment->save();

            DB::commit();

            return $appointment;

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Erro ao criar funcionário', [
                'error' => $e->getMessage(),
                'data' => $data
            ]);
            throw $e;
        }
    }

    /**
     * Update client
     */
    public function update(int $appointmentId, array $data): Appointment
    {
        DB::beginTransaction();
        try {
            $appointment = Appointment::findOrFail($appointmentId);

            // Update Appointment
            $appointment->employee_id = $data['employee_id'];
            $appointment->client_id = $data['client_id'];
            $appointment->service_id = $data['service_id'];
            $appointment->save();

            DB::commit();

            return $appointment->fresh();

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Erro ao atualizar agendamento', [
                'appointment_id' => $appointmentId,
                'error' => $e->getMessage(),
                'data' => $data
            ]);
            throw $e;
        }
    }

    /**
     * Delete appointment
     */
    public function delete(int $appointmentId): bool
    {
        DB::beginTransaction();
        try {
            $appointment = Appointment::findOrFail($appointmentId);

            // Delete Appointment
            $appointment->deleteWithLog();

            DB::commit();
            return true;

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Erro ao deletar agendamento', [
                'appointment_id' => $appointmentId,
                'error' => $e->getMessage()
            ]);
            throw $e;
        }
    }

    /**
     * Search appointments by id
     */
    public function find(int $appointmentId): ?Appointment
    {
        return Appointment::findOrFail($appointmentId);
    }

    /**
     * List all appointments
     */
    public function all()
    {
        return Appointment::latest()->get();
    }

}
