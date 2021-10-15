<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Attendance extends Model
{
    protected $table = 'attendance';

    public function getIsRegisteredAttribute()
    {
        return $this->where('user_id', Auth::id())
            ->where('date', now()->format('Y-m-d'))
            ->exists();
    }
}
