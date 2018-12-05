<?php

namespace App\Http\Resources;

use App\Http\Resources\Question as QuestionResource;
use App\Http\Resources\Result as ResultResource;
use Illuminate\Http\Resources\Json\JsonResource;

class Quiz extends JsonResource
{
    public function toArray($request)
    {
        return [
//            'id' => $this->id,
            'quiz_title' => $this->quiz_title,
            'quiz_sub_title' => $this->quiz_sub_title,
            'questions' => QuestionResource::collection($this->question),
//            'results' => ResultResource::collection($this->result)
        ];
    }
}
