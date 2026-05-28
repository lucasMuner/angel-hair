<?php

namespace App\Helpers;

class DurationHelper
{
    public static function format(int $duration): string
    {
        $hours = floor($duration / 60);
        $minutes = $duration % 60;

        if ($hours > 0) {
            return sprintf('%d hora(s) e %d minuto(s)', $hours, $minutes);
        }

        return sprintf('%d minuto(s)', $minutes);
    }
}
