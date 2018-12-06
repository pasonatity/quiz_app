<?php

namespace App\Http\Resources;

use App\Models\Item;
//use App\Models\Question;
use App\Http\Resources\ItemResource;
use Illuminate\Http\Resources\Json\JsonResource;

class QuestionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $correct_item = Item::whereCorrectItem($this->id)->get();
        $incorrect_item = Item::whereIncorrectItem($this->id)->get();
        $sample = ItemResource::collection($correct_item);

        return [
            'id' => $this->id,
//            'quiz_id' => $this->quiz_id,
            'content' => $this->question_content,
            'correct' => ItemResource::collection($correct_item),
            'incorrect' => ItemResource::collection($incorrect_item),
            'item' => ItemResource::collection($this->item)
        ];
    }
}
