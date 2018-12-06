<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'quiz_id', 'question_content',
    ];

    public function quiz()
    {
        return $this->belongsTo('App\Models\Quiz');
    }

    public function item()
    {
        return $this->hasMany('App\Models\item');
    }

}
