<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DailyReport extends Model
{
    use SoftDeletes;

    protected $table = 'daily_reports';

    protected $dates = [
        'reporting_time',
        'deleted_at',
    ];

    protected $fillable = [
        'user_id',
        'title',
        'content',
        'reporting_time'
    ];

    public function searchByYearMonth($yearMonth)
    {
        return $this->where('reporting_time', 'LIKE', $yearMonth . '%')
            ->orderByDesc('reporting_time')
            ->paginate(config('const.paginate'));
    }
}
