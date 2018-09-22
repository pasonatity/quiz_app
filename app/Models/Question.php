<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    public function quiz()
    {
        return $this->belongsTo('App\Models\Quiz');
    }

    public function item()
    {
        return $this->hasMany('App\Models\item');
    }
}
