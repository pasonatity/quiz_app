<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ItemViewResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'item_content' => $this->item_content,
            'correct' => $this->correct
        ];
    }
}
