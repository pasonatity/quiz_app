<?php

namespace App\Http\Resources;

use App\Http\Resources\ItemViewResource;
use Illuminate\Http\Resources\Json\JsonResource;

class QuestionViewResource extends JsonResource
{
    public function toArray($request)
    {
        return [
//            'id' => $this->id,
//            'quiz_id' => $this->quiz_id,
            'question_content' => $this->question_content,
            'items' => ItemViewResource::collection($this->item)
        ];
    }
}
