<?php

namespace App\Http\Resources;

use App\Http\Resources\Item as ItemResource;
use Illuminate\Http\Resources\Json\JsonResource;

class Question extends JsonResource
{
    public function toArray($request)
    {
        return [
//            'id' => $this->id,
//            'quiz_id' => $this->quiz_id,
            'question_content' => $this->question_content,
            'items' => ItemResource::collection($this->item)
        ];
    }
}
