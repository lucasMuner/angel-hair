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

    public function getAvailableTimes(int $employeeId, string $date, ?int $excludeId = null): array
    {
        $query = self::where('employee_id', $employeeId)
            ->whereDate('date', $date)
            ->select('start_time', 'end_time');

        if ($excludeId) {
            $query->where('id', '!=', $excludeId);
        }

        $existingAppointments = $query->get()->toArray();

        $startTime = strtotime('11:00');
        $endTime = strtotime('22:00');
        $lunchStart = strtotime('14:00');
        $lunchEnd = strtotime('15:00');
        $allTimes = [];

        for ($time = $startTime; $time < $endTime; $time += 30 * 60) {
            if ($time >= $lunchStart && $time < $lunchEnd) {
                continue;
            }
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
