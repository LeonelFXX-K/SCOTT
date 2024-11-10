<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
        'type',
        'report_date',
        'start_time',
        'end_time',
        'duration',
        'reported_by',
        'attended_by',
        'status',
    ];

    public function details()
    {
        return $this->hasMany(ReportDetail::class);
    }
}
