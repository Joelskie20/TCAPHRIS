<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = ['name'];

    public function user()
    {
        $this->belongsTo('App\User', 'id', 'department_id');
    }
}
