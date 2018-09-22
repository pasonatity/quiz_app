<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    public function question()
    {
        return $this->hasMany('App\Models\Question');
    }

    public function result()
    {
        return $this->hasMany('App\Models\Result');
    }

    public function tag()
    {
        return$this->hasMany('App\Models\Tag');
    }
}
