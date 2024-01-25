<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EditionResource extends JsonResource
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
            'identifier' => $this->identifier,
            'language'=> $this->language,
            'name'=> $this->name,
            'englishName'=> $this->englishName,
            'format'=> $this->format,
            'type'=> $this->type,
        ];
    }
}
