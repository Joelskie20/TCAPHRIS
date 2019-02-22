<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkshiftSched extends Model
{
    protected $table = 'user_workshift_schedules';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
