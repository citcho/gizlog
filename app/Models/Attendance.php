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

    protected $dates = [
        'date',
    ];

    public function getIsClockInAttribute()
    {
        return isset($this->start_time) && !isset($this->end_time) ? true : false;
    }

    public function getIsClockOutAttribute()
    {
        return isset($this->start_time) && isset($this->end_time) ? true : false;
    }

    public function getIsAbsenceAttribute()
    {
        return $this->is_absent === 1 ? true : false;
    }
}
