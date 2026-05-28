<?php

namespace App\Models;

use App\Traits\LogsModelChanges;
use Illuminate\Database\Eloquent\Model;
use App\Models\Client;
use App\Models\Employee;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class Appointment extends Model
{
    use LogsModelChanges;

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function getAvailableTimes(int $employeeId, int $serviceId, string $date, ?int $excludeId = null): array
    {
        $query = self::where('employee_id', $employeeId)
            ->whereDate('date', $date)
            ->select('start_time', 'end_time');

        if ($excludeId) {
            $query->where('id', '!=', $excludeId);
        }

        $serviceDuration = Service::find($serviceId)->duration ?? 30;

        $existingAppointments = $query->get()->toArray();

        $startTime = strtotime('11:00');
        $endTime = strtotime('22:00');
        $lunchStart = strtotime('14:00');
        $lunchEnd = strtotime('15:00');
        $allTimes = [];

        $lunchDateTime = Carbon::createFromFormat('Y-m-d H:i', $date . ' 14:00');
        $dayEndDateTime = Carbon::createFromFormat('Y-m-d H:i', $date . ' 22:00');

        for ($time = $startTime; $time < $endTime; $time += 30 * 60) {
            if ($time >= $lunchStart && $time < $lunchEnd) continue;

            // Check if the time slot can accommodate the service duration
            $startDatetime = Carbon::createFromFormat('Y-m-d H:i', $date . ' ' . date('H:i', $time));
            $endDatetime = $startDatetime->copy()->addMinutes($serviceDuration);

            if($startDatetime->lte($lunchDateTime) && $endDatetime->gt($lunchDateTime)) continue;
            if($startDatetime->lt($dayEndDateTime) && $endDatetime->gt($dayEndDateTime)) continue;

            //If the new appointment conflits with a existent one, skip it
            $conflict = false;
            foreach ($existingAppointments as $appointment) {
                $appointmentStart = Carbon::createFromFormat('Y-m-d H:i:s', $appointment['start_time']);
                $appointmentEnd = Carbon::createFromFormat('Y-m-d H:i:s', $appointment['end_time']);
                $conflict = ($startDatetime->lt($appointmentStart) && $startDatetime->lt($appointmentEnd))
                     && ($endDatetime->gt($appointmentStart) && $endDatetime->lt($appointmentEnd));
                if ($conflict) break;
            }

            if ($conflict) continue;

            $allTimes[] = date('H:i', $time);
        }

        $result = array_values(array_filter($allTimes, function ($slot) use ($existingAppointments, $date) {
            $slotTime = strtotime($date . ' ' . $slot);

            foreach ($existingAppointments as $appointment) {
                $start = strtotime($appointment['start_time']);
                $end   = strtotime($appointment['end_time']);

                if ($slotTime >= $start && $slotTime < $end) {
                    return false;
                }
            }

            return true;
        }));

        return $result;
    }
}
