<?php

namespace App\Formatters;

use Carbon\Carbon;

class DateFormatter
{
    /**
     * Carbon $date
     */
    private $date;

    /**
     * Inject Date from Entity
     */
    public function __construct($date)
    {
        $this->date = Carbon::parse($date);
    }

    /**
     * Format Date for Form Use
     */
    public function forForm()
    {
        return $this->date->format('d-m-Y');
    }

    public function forFormHour()
    {
        return $this->date->format('d-m-Y H:i:s');
    }

    /**
     * Format date for Profile
     */
    public function forHumans()
    {
        return $this->date->diffForHumans();
    }

    public function subDays($days)
    {
        return $this->date->subDays($days);
    }

    public function lt($date)
    {
        return $this->date->lt($date);
    }
}
