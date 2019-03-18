<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\CarbonPeriod;

class WorkshiftSched extends Model
{
    protected $table = 'user_workshift_schedules';

    public $timestamps = false;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function workshift()
    {
        return $this->belongsTo(Workshift::class);
    }

    public static function getAllDays($start, $end)
    {
        $period = CarbonPeriod::create($start, $end);

        return collect($period);
    }
}
