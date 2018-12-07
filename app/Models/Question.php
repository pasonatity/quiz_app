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

    public function scopeWhereQuiz($query, $quiz_id)
    {
        return $query->whereHas('quiz', function ($q) use($quiz_id) {
            $q->where('quiz_id', $quiz_id);
        });
    }
}
