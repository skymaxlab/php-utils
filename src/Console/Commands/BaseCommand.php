<?php

namespace SkyMaxLab\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use SkyMaxLab\Date\DateUtil;

class BaseCommand extends Command
{
    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Get date options.
     *
     * @param string $timezone
     *
     * @return array
     */
    public function getDatesOption($timezone = 'America/Toronto')
    {
        $date = $this->option('date');
        $from = $this->option('from');
        $to = $this->option('to');

        $dates = [];
        if (!empty($date)) {
            $dates[] = $date;
        } elseif (!empty($from) && !empty($to)) {
            $dates = DateUtil::range($from, $to);
        } else {
            $dates[] = Carbon::now()->setTimezone($timezone)->toDateString();
        }

        return $dates;
    }
}
