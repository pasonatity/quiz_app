<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Result extends JsonResource
{
    public function toArray($request)
    {
        return [
//            'id' => $this->id,
//            'quiz_id' => $this->quiz_id,
            'correct_number' => $this->correct_number,
            'comment' => $this->comment
        ];
    }
}
