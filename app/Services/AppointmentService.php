<?php

namespace App\Services;

use App\Contracts\AppointmentServiceInterface;
use Illuminate\Support\Facades\DB;
use App\Models\Appointment;
use App\Models\Service;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class AppointmentService implements AppointmentServiceInterface
{
    public function store(array $data): Appointment
    {
        DB::beginTransaction();
        try {
            $service = Service::findOrFail($data['service_id']);
            $duration = $service->duration ?? 30;

            $startTime = Carbon::createFromFormat(
                'Y-m-d H:i',
                $data['scheduled_at'] . ' ' . $data['scheduled_time']
            );
            $endTime = $startTime->copy()->addMinutes($duration);

            // Create Appointment
            $appointment = new Appointment();
            $appointment->employee_id = $data['employee_id'];
            $appointment->client_id = $data['client_id'];
            $appointment->service_id = $data['service_id'];
            $appointment->date = $data['scheduled_at'];
            $appointment->start_time = $startTime;
            $appointment->end_time = $endTime;
            $appointment->save();

            DB::commit();

            return $appointment;

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Erro ao criar agendamento', [
                'error' => $e->getMessage(),
                'data' => $data
            ]);
            throw $e;
        }
    }

    /**
     * Update appointment
     */
    public function update(int $appointmentId, array $data): Appointment
    {
        DB::beginTransaction();
        try {
            $appointment = Appointment::findOrFail($appointmentId);

            $service = Service::findOrFail($data['service_id']);
            $duration = $service->duration ?? 30;

            $startTime = \Carbon\Carbon::createFromFormat(
                'Y-m-d H:i',
                $data['scheduled_at'] . ' ' . $data['scheduled_time']
            );
            $endTime = $startTime->copy()->addMinutes($duration);

            // Update Appointment
            $appointment->employee_id = $data['employee_id'];
            $appointment->client_id = $data['client_id'];
            $appointment->service_id = $data['service_id'];
            $appointment->date = $data['scheduled_at'];
            $appointment->start_time = $startTime;
            $appointment->end_time = $endTime;
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

    public function getAvailableTimes(int $employeeId, int $serviceId, string $date): array
    {
        $appointment = new Appointment();
        return $appointment->getAvailableTimes($employeeId, $serviceId, $date);
    }
}
