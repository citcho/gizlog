<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\AbsenceRequest;
use App\Http\Requests\User\AttendanceRequest;
use App\Http\Requests\User\ModifyRequest;
use App\Services\AttendanceService;

class AttendanceController extends Controller
{
    private $attendanceService;

    public function __construct(AttendanceService $attendanceService)
    {
        $this->attendanceService = $attendanceService;        
    }

    public function index()
    {
        $myTodayAttendance = $this->attendanceService->getMyTodayAttendance();

        return view('user.attendance.index', compact('myTodayAttendance'));
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
        $myAttendances = $this->attendanceService->fetchAllMyAttendances();
        return view('user.attendance.mypage', compact('myAttendances'));
    }

    public function clockIn(AttendanceRequest $request)
    {
        $this->attendanceService->storeStartTime($request->all());

        return redirect()->route('attendance.index');
    }

    public function clockOut(AttendanceRequest $request)
    {
        $this->attendanceService->storeEndTime($request->all());

        return redirect()->route('attendance.index');
    }

    public function absent(AbsenceRequest $request)
    {
        $this->attendanceService->absent($request->all());
        return redirect()->route('attendance.index');
    }

    public function modify(ModifyRequest $request)
    {
        $this->attendanceService->modify($request->all());
        return redirect()->route('attendance.index');
    }
}
