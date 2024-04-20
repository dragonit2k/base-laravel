<?php

namespace App\Helpers;

use Carbon\Carbon;

class CommonHelper 
{
        /**
     * Date between
     *
     * @param  string  $date
     * @return array
     */
    public static function dateBetween($date): array
    {
        $pattern = REGEX_DATE_BETWEEN;
        if (preg_match($pattern, $date)) {
            $data = explode(' - ', $date);
            $start = Carbon::createFromFormat('d/m/Y', trim($data[0]))->format('Y-m-d') . ' 00:00:00';
            $end = Carbon::createFromFormat('d/m/Y', trim($data[1]))->format('Y-m-d') . ' 23:59:59';

            return [$start, $end];
        }

        return [];
    }

    
    /**
     * Max character display
     *
     * @param  string  $data
     * @return String
     */
    public static function maxCharacterDisplay($data, $maxChar = MAX_CHARACTER_DISPLAY)
    {
        $convert = str_replace(['\r\n', ' '], '', $data);
        if (!empty($convert) && mb_strlen($convert) > $maxChar) {
            return mb_substr($data, 0, $maxChar) . MORE;
        }
        return $data;
    }

    
    /**
     * Format time.
     *
     * @param string $time
     * @param string $format
     * @return string|null
     */
    public static function formatTime($time, $format = TIME_FORMAT)
    {
        if (!empty($time)) {
            return Carbon::parse($time)->format($format);
        }

        return '';
    }

    
    /**
     * Escape special characters for a LIKE query.
     *
     * @param string $value
     * @param string $char
     *
     * @return string
     */
    public static function escapeStr(string $value, string $char = '\\'): string
    {
        return str_replace(
            [$char, '%', '_'],
            [$char . $char, $char . '%', $char . '_'],
            $value
        );
    }
}