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
        $correct_item = Item::whereCorrectItem($this->id)->first();
        $incorrect_item = Item::whereIncorrectItems($this->id)->get();

        return [
//            'id' => $this->id,
//            'quiz_id' => $this->quiz_id,
            'content' => $this->question_content,
            'correct' => $correct_item->item_content,
            'incorrect' => ItemResource::collection($incorrect_item),
//            'item' => ItemResource::collection($this->item)
        ];
    }
}
