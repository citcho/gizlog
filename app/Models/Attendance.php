<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Attendance extends Model
{
    protected $fillable = [
        'date',
        'start_time',
        'end_time',
        'absent_reason',
        'request_content',
    ];

    public function absence()
    {
        return $this->hasOne(Absence::class, 'attendance_id', 'id');
    }

    public function getIsClockInAttribute()
    {
        return $this->where('user_id', Auth::id())
            ->where('date', now()->format('Y-m-d'))
            ->whereNotNull('start_time')
            ->whereNull('end_time')
            ->exists();
    }

    public function getIsClockOutAttribute()
    {
        return $this->where('user_id', Auth::id())
            ->where('date', now()->format('Y-m-d'))
            ->whereNotNull('start_time')
            ->whereNotNull('end_time')
            ->exists();
    }
}
