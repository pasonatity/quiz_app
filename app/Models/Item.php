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
}
