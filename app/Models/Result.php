<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    public function quiz()
    {
        return $this->belongsTo('App\Models\Result');
    }
}
