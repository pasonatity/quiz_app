<?php

namespace App\Http\Resources;

use App\Http\Resources\QuestionViewResource;
use App\Http\Resources\ResultResource;
use Illuminate\Http\Resources\Json\JsonResource;

class QuizViewResource extends JsonResource
{
    public function toArray($request)
    {
        return [
//            'id' => $this->id,
            'quiz_title' => $this->quiz_title,
            'quiz_sub_title' => $this->quiz_sub_title,
            'questions' => QuestionViewResource::collection($this->question)->random($this->question_number),
//            'results' => ResultResource::collection($this->result)
        ];
    }
}
