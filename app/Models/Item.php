<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'question_id', 'item_content', 'correct'
    ];

    public function question()
    {
        return $this->belongsTo('App\Models\Question');
    }

    public function scopeWhereCorrectItem($query, $question_id)
    {
        return $query->whereHas('question', function ($q) use($question_id) {
            $q->where('question_id', $question_id)->where('correct', true);
        });
    }

    public function scopeWhereIncorrectItem($query, $question_id)
    {
        return $query->whereHas('question', function ($q) use($question_id) {
            $q->where('question_id', $question_id)->where('correct', false);
        });
    }
}
