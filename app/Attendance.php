<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $guarded = [];
    
    public static function checkAttendanceStatus()
    {
        return static::where([
            ['user_id', '=', auth()->id()],
            ['time_out', '=', null]
        ])->first();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function approvedLeaves()
    {
        return $this->user->leaves()->where('status', 'approved')->get();
    }

    public function leaveDates()
    {
        return $this->user->leaves()->where('status', 'approved')->pluck('leave_date');
    }
}
