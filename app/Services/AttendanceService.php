<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Absence;
use App\Models\Attendance;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

Class AttendanceService
{
    private $attendance;
    private $absence;

    public function __construct(Attendance $attendance, Absence $absence)
    {
        $this->attendance = $attendance;
        $this->absence = $absence;
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

        if (is_null($todayAttendance)) {
            DB::transaction(function () use ($attributes) {
                $todayAttendance = $this->attendance
                    ->create([
                        'user_id' => Auth::id(),
                        'date' => now()->format('Y-m-d'),
                    ]);
                $this->absence->create([
                    'attendance_id' => $todayAttendance->id,
                    'is_absent' => 1,
                    'reason' => $attributes['reason'],
                ]);
            });
        } else {
            if (!$todayAttendance->hasAbsenceRequest) {
                $this->absence->create([
                    'attendance_id' => $todayAttendance->id,
                    'is_absent' => 1,
                    'reason' => $attributes['reason'],
                ]);
            } else {
                session()->flash('failed_absent_msg', '既に欠席登録がされています。');
            }
        }
    }
}