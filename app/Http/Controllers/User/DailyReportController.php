<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\DailyReportRequest;
use App\Models\DailyReport;
use Illuminate\Support\Facades\Auth;

class DailyReportController extends Controller
{
    private $dailyReport;

    public function __construct(DailyReport $dailyReport)
    {
        $this->middleware('auth');
        $this->dailyReport = $dailyReport;
    }

    public function index()
    {
        $dailyReports = $this->dailyReport->orderByDesc('reporting_time')->paginate(config('const.paginate'));
        return view('user.daily_report.index', compact('dailyReports'));
    }

    public function showCreatePage()
    {
        return view('user.daily_report.create');
    }

    public function store(DailyReportRequest $request)
    {
        $dailyReport = $this->dailyReport->fill($request->all());
        $dailyReport->user_id = Auth::id();
        $dailyReport->save();
        return redirect()->route('report.index');
    }

    public function showDetailPage($reportId)
    {
        $dailyReport = $this->dailyReport->find($reportId);
        return view('user.daily_report.show', compact('dailyReport'));
    }

    public function showEditPage($reportId)
    {
        $dailyReport = $this->dailyReport->find($reportId);
        return view('user.daily_report.edit', compact('dailyReport'));
    }

    public function edit(DailyReportRequest $request, $reportId)
    {
        $this->dailyReport->find($reportId)->fill($request->all())->save();
        return redirect()->route('report.index');
    }

    public function delete($reportId)
    {
        $this->dailyReport->find($reportId)->delete();
        return redirect()->route('report.index');
    }
}
