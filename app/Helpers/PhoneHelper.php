<?php

namespace App\Helpers;

class PhoneHelper
{
    public static function format(string $phone): string
    {
        $phone = preg_replace('/\D/', '', $phone);

        if (strlen($phone) === 11) {
            return sprintf('(%s) %s-%s',
                substr($phone, 0, 2),
                substr($phone, 2, 5),
                substr($phone, 7)
            );
        }

        if (strlen($phone) === 10) {
            return sprintf('(%s) %s-%s',
                substr($phone, 0, 2),
                substr($phone, 2, 4),
                substr($phone, 6)
            );
        }

        return $phone;
    }

    public static function strip(string $phone): string
    {
        return preg_replace('/\D/', '', $phone);
    }
}
