<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    public $fillable = ['name'];

    public function teams()
    {
        return $this->hasMany(Team::class);
    }

    public function accounts()
    {
        return $this->hasManyThrough(Account::class, Team::class);
    }
}
