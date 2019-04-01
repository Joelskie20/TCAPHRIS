<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
    protected $guarded = [];

    public static function dates()
    {
        return Holiday::all()->pluck('date');
    }
}
