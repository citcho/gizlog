<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DailyReportController extends Controller
{
    public function __construct()
    {
        
    }

    public function index()
    {
        return view('user.daily_report.index');
    }
}
