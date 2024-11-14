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

    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }

    public function reportDetails()
    {
        return $this->hasMany(ReportDetail::class);
    }

    public function reportedBy()
    {
        return $this->belongsTo(User::class, 'reported_by');
    }
}
