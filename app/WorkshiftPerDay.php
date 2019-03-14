<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkshiftPerDay extends Model
{
    protected $guarded = [];

    protected $table = 'user_workshift_per_day';

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
