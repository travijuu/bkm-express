<?php
namespace Travijuu\BkmExpress\Utility;

use DateTime;

class Calculate
{

    /**
     * This calculates time difference in seconds between now and given timestamp
     *
     * @param string $ts
     * @param string $format
     * @return int
     */
    public static function timeDiff($ts, $format = 'Ymd-H:i:s')
    {
        $date = date_create_from_format($format, $ts);
        $now  = new DateTime();
        $diff = $date->diff($now);

        return abs($diff->days * 24 * 60 * 60 + $diff->h * 60 * 60 + $diff->i * 60 + $diff->s);
    }
}