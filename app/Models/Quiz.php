<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{

    protected $fillable = [
        'user_id', 'quiz_title', 'quiz_sub_title', 'challenge_number',
        'public_type', 'question_number', 'question_sum', 'correct_sum',
    ];

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
        return $this->hasMany('App\Models\Tag');
    }

    public function mst_public_type()
    {
        return $this->belongsTo('App\Models\MstPublicType');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function scopeWhereKeyword($query, $keyword)
    {
        if(empty($keyword)) {
            return $query;
        } else {
            return $query
                ->where(function ($q) use ($keyword) {
                    $q
                        ->where('quiz_title', 'like', '%'. $keyword. '%')
                        ->orWhere('quiz_sub_title', 'like', '%'. $keyword. '%')
                    ;
                });
        }
    }

    public function scopeWhereTag($query, $tag_id)
    {
        return $query->whereHas('tag', function ($q) use($tag_id) {
            $q->where('id', $tag_id);
        });
    }

    public function scopeWhereUser($query, $user_id)
    {
        return $query->whereHas('user', function ($q) use($user_id) {
            $q->where('id', $user_id);
        });
    }
}
