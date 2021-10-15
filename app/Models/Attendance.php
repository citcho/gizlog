<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Attendance extends Model
{
    protected $table = 'attendance';

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
