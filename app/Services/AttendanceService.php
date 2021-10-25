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

    public function getMyTodayAttendance()
    {
        return $this->attendance
            ->where('user_id', Auth::id())
            ->where('date', now()->format('Y-m-d'))
            ->first();
    }

    public function storeStartTime(array $attributes)
    {   
        $this->attendance->fill($attributes);
        $this->attendance->user_id = Auth::id();

        $this->attendance->save();
    }

    public function storeEndTime(array $attributes)
    {   
        $attendance = $this->attendance
            ->where('date', $attributes['date'])
            ->where('user_id', Auth::id())
            ->first();

        $attendance->end_time = $attributes['end_time'];

        $attendance->save();
    }

    public function absent(array $attributes)
    {
        $todayAttendance = $this->attendance
            ->where('date', now()->format('Y-m-d'))
            ->where('user_id', Auth::id())
            ->first();

        if (is_null($todayAttendance)) {
            $this->attendance->is_absent = 1;
            $this->attendance->absent_reason = $attributes['absent_reason'];
            $this->attendance->user_id = Auth::id();
            $this->attendance->date = now()->format('Y-m-d');

            $this->attendance->save();
        } else {
            $todayAttendance->is_absent = 1;
            $todayAttendance->absent_reason = $attributes['absent_reason'];

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

    public function fetchAllMyAttendances()
    {
        return $this->attendance
            ->where('user_id', Auth::id())
            ->orderByDesc('date')
            ->get();
    }

    public function fetchAllStudyHours($attendances)
    {
        $totalHours = 0;
        $totalMinutes = 0;
        
        foreach ($attendances as $attendance) {
            $startTime = new \DateTime($attendance->start_time);
            $endTime = new \DateTime($attendance->end_time);
            
            $diff = $startTime->diff($endTime);
        
            $totalHours += $diff->format('%h');
            $totalMinutes += $diff->format('%i');
        }
        
        return $totalHours + round($totalMinutes / 60);
    }
}