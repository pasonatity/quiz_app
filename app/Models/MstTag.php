<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MstTag extends Model
{
    public function tag()
    {
        return $this->hasOne('App\Models\Tag');
    }
}
