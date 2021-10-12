<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class AttendanceController extends Controller
{
    public function index()
    {
        return view('user.attendance.index');
    }
}
