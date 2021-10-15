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

    public function storeStartTime(array $attributes)
    {   
        if (!$this->attendance->isRegistered) {
            $this->attendance->user_id = Auth::id();
            $this->attendance->date = $attributes['date'];
            $this->attendance->start_time = $attributes['start_time'];
    
            $this->attendance->save();
        }
    }
}