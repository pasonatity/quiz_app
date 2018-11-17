<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MstPublicType extends Model
{
    public function quiz()
    {
        return $this->hasOne('App\Models\Quiz');
    }
}
