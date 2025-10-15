<?php

// namespace App\Http\Helpers;

use App\Models\Bbs\MenuItem;
use App\Models\Event;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


if (!function_exists('get_label')) {

    function get_label($label, $default, $locale = '')
    {
        if (Lang::has('labels.' . $label, $locale)) {
            return trans('labels.' . $label, [], $locale);
        } else {
            return $default;
        }
    }
}

if (!function_exists('getQrCode')) {

    function getQrCode($id, $size)
    {
        // $qr_code = QrCode::size($size)->generate($id);
        $qr_code = base64_encode(QrCode::format('svg')->size($size)->errorCorrection('H')->generate($id));

        return ($qr_code);
    }
}

if (!function_exists('time_range_segment')) {

    function time_range_segment($time_range, $segment)
    {
        if ($segment == 'from') {
            $return_segment = Str::substr($time_range, 0,  Str::position($time_range, "-") - 1);
            return $return_segment;
        } elseif ($segment == 'to') {
            $return_segment = Str::substr($time_range, Str::position($time_range, "-") + 1);
            return $return_segment;
        } else {
            return null;
        }
    }
}

/**
 * Generate initials from a name
 *
 * @param string $name
 * @return string
 */
if (!function_exists('generate')) {
    function generateInitials(string $name): string
    {
        $words = explode(' ', $name);
        if (count($words) >= 2) {
            return mb_strtoupper(
                mb_substr($words[0], 0, 1, 'UTF-8') .
                    mb_substr(end($words), 0, 1, 'UTF-8'),
                'UTF-8'
            );
        }
        return makeInitialsFromSingleWord($name);
    }
}

/**
 * Make initials from a word with no spaces
 *
 * @param string $name
 * @return string
 */
if (!function_exists('makeInitialsFromSingleWord')) {
    function makeInitialsFromSingleWord(string $name): string
    {
        preg_match_all('#([A-Z]+)#', $name, $capitals);
        if (count($capitals[1]) >= 2) {
            return mb_substr(implode('', $capitals[1]), 0, 2, 'UTF-8');
        }
        return mb_strtoupper(mb_substr($name, 0, 2, 'UTF-8'), 'UTF-8');
    }
}


if (!function_exists('format_date')) {
    function format_date($date, $time = null, $format = null, $apply_timezone = true)
    {
        if ($date) {
            // Log::info('date: '.$date);
            // Log::info('time: '.$time);
            // Log::info('format: '.$format);
            $format = $format ?? get_php_date_format();
            $time = $time ?? '';

            $date = $time != '' ? \Carbon\Carbon::parse($date) : \Carbon\Carbon::parse($date);

            // Log::info('date: '.$date);

            // if ($time !== '') {
            //     if ($apply_timezone) {
            //         $date->setTimezone(config('app.timezone'));
            //     }
            //     $format .= ' ' . $time;
            // }

            // Log::info($date->format($format));

            return $date->format($format);
        } else {
            return '-';
        }
    }
}

if (!function_exists('get_php_date_format')) {
    function get_php_date_format()
    {
        // $general_settings = get_settings('general_settings');
        $date_format = 'DD-MM-YYYY|d-m-Y';
        // $date_format = $general_settings['date_format'] ?? 'DD-MM-YYYY|d-m-Y';
        $date_format = explode('|', $date_format);
        return $date_format[1];
    }
}

if (!function_exists('get_settings')) {

    // function get_settings($variable)
    // {
    //     $fetched_data = Setting::all()->where('variable', $variable)->values();
    //     if (isset($fetched_data[0]['value']) && !empty($fetched_data[0]['value'])) {
    //         if (isJson($fetched_data[0]['value'])) {
    //             $fetched_data = json_decode($fetched_data[0]['value'], true);
    //         }
    //         return $fetched_data;
    //     }
    // }
}

if (!function_exists('generateSecurePassword')) {
    function generateSecurePassword($length = 12)
    {
        $lowercase    = 'abcdefghijklmnopqrstuvwxyz';
        $uppercase    = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $numbers      = '0123456789';
        $specialChars = '!@#$%^&*()-_=+<>?';

        // Ensure at least one of each
        $password = '';
        $password .= $lowercase[random_int(0, strlen($lowercase) - 1)];
        $password .= $uppercase[random_int(0, strlen($uppercase) - 1)];
        $password .= $numbers[random_int(0, strlen($numbers) - 1)];
        $password .= $specialChars[random_int(0, strlen($specialChars) - 1)];

        // Fill the rest
        $all = $lowercase . $uppercase . $numbers . $specialChars;
        for ($i = strlen($password); $i < $length; $i++) {
            $password .= $all[random_int(0, strlen($all) - 1)];
        }

        // Shuffle to randomize order
        return str_shuffle($password);
    }
}

if (!function_exists('forget_menu_session')) {

    function forget_menu_session()
    {
        $menu_items = MenuItem::all();
        foreach ($menu_items as $item) {
            session()->forget($item->link);
        }
    }
}

