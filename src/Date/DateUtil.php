<?php

namespace SkyMaxLab\Date;

use Carbon\Carbon;
use DateTime;
use InvalidArgumentException;

class DateUtil
{
    /**
     * Get an instance of the class.
     *
     * @return DateUtil
     */
    public static function getInstance()
    {
        return new DateUtil;
    }

    /**
     * Return true if the date is in the valid format.
     *
     * @param $date
     * @param string $format
     *
     * @return bool
     */
    public static function isDate($date, $format = 'Y-m-d')
    {
        $newDate = DateTime::createFromFormat($format, $date);

        return $newDate && $newDate->format($format) === $date;
    }

    /**
     * Return a range of dates in Y-m-d format
     *
     * @param $from
     * @param $to
     *
     * @return array
     */
    public static function range($from, $to, $format = 'Y-m-d')
    {
        if (!static::isDate($from, $format)) {
            throw new InvalidArgumentException(sprintf('%s is not a valid date in %s format.', $from, $format));
        }
        if (!static::isDate($to, $format)) {
            throw new InvalidArgumentException(sprintf('%s is not a valid date in %s format.', $to, $format));
        }

        $from = Carbon::parse($from);
        $to = Carbon::parse($to);

        $dates = [];
        while ($from->lte($to)) {
            $dates[] = $from->format($format);
            $from->addDay(1);
        }

        return $dates;
    }
}
