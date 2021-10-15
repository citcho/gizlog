<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class AttendanceController extends Controller
{
    public function index()
    {
        return view('user.attendance.index');
    }

    public function showAbsenceRegistrationPage()
    {
        return view('user.attendance.absence');
    }

    public function showModifyRequestPage()
    {
        return view('user.attendance.modify');
    }

    public function showMyPage()
    {
        return view('user.attendance.mypage');
    }
}
