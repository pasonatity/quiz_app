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
        return $this->hasMany('App\Models\Tag');
    }

    public function mst_public_type()
    {
        return $this->belongsTo('App\Models\MstPublicType');
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
}
