<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AyahEditionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'edition_id' => $this->edition_id,
            'data' => $this->data,
            'ayah' => new AyahResource($this->ayah),
        ];
    }
}
