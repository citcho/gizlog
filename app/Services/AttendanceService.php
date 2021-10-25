<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Attendance;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

    public function absent(array $attributes)
    {
        $todayAttendance = $this->attendance
            ->where('date', now()->format('Y-m-d'))
            ->where('user_id', Auth::id())
            ->first();

        if (isset($todayAttendance)) {
            $todayAttendance->absent_reason = $attributes['absent_reason'];
            $todayAttendance->is_absent = 1;

            $todayAttendance->save();
        } else {
            $todayAttendance = $this->attendance->fill($attributes);
            $todayAttendance->user_id = Auth::id();
            $todayAttendance->is_absent = 1;

            $todayAttendance->save();
        }
    }

    public function modify(array $attributes)
    {
        $attendance = $this->attendance
            ->where('date', $attributes['date'])
            ->where('user_id', Auth::id())
            ->first();

        if (isset($attendance)) {
            $attendance->request_content = $attributes['request_content'];

            $attendance->save();
        }
    }
}