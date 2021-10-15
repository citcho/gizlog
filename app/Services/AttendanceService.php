<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Attendance;
use Illuminate\Support\Facades\Auth;

Class AttendanceService
{
    private $attendance;

    public function __construct(Attendance $attendance)
    {
        $this->attendance = $attendance;
    }

    public function getAttendance()
    {
        return $this->attendance;
    }

    public function storeStartTime(array $attributes)
    {   
        if (!$this->attendance->isClockIn && !$this->attendance->isClockOut) {
            $this->attendance->user_id = Auth::id();
            $this->attendance->date = $attributes['date'];
            $this->attendance->start_time = $attributes['start_time'];
    
            $this->attendance->save();
        }
    }

    public function storeEndTime(array $attributes)
    {   
        if ($this->attendance->isClockIn && !$this->attendance->isClockOut) {
            $attendance = $this->attendance
                ->where('user_id', Auth::id())
                ->where('date', now()->format('Y-m-d'))
                ->first();

            $attendance->end_time = $attributes['end_time'];
    
            $attendance->save();
        }
    }
}