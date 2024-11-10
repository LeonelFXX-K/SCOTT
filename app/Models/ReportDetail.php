<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReportDetail extends Model
{
    protected $fillable = [
        'report_id',
        'channel_id',
        'category',
        'protocol',
        'stage',
        'media',
        'description',
    ];

    public function report()
    {
        return $this->belongsTo(Report::class);
    }

    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }
}
