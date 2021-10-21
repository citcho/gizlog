<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Absence extends Model
{
    protected $table = 'absence';

    protected $fillable = [
        'attendance_id',
        'reason',
        'is_absent',
    ];
}
