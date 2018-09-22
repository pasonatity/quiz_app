<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function quiz()
    {
        return $this->belongsTo('App\Models\Quiz');
    }

    public function mst_tag()
    {
        return $this->belongsTo('App\Models\MstTag');
    }

}
