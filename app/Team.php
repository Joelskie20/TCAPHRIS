<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = ['division_id', 'name'];

    public function division()
    {
        return $this->belongsTo(Division::class);
    }
}
