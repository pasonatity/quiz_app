<?php

namespace App\Http\Resources;

use App\Http\Resources\QuestionResource;
use App\Http\Resources\ResultResource;
use Illuminate\Http\Resources\Json\JsonResource;

class QuizResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
//            'id' => $this->id,
            'quizTitle'    => $this->quiz_title,
            'quizSubTitle' => $this->quiz_sub_title,
            'questions'    => QuestionResource::collection($this->question),
//            'results'    => ResultResource::collection($this->result)
            'publicType'   => $this->public_type
        ];
    }
}
