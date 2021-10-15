<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Attendance;

Class AttendanceService
{
    private $attendance;

    public function __construct(Attendance $attendance)
    {
        $this->attendance = $attendance;
    }
}