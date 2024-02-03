<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AyahResource extends JsonResource
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
            'number' => $this->number,
            'text' => $this->text,
            'number_in_surah' => $this->number_in_surah,
            'page'=> $this->page,
            'surah_id'=> $this->surah_id,
            'hizb_id'=> $this->hizb_id,
            'juz_id'=> $this->juz_id,
            'sajda' => $this->sajda,
            'textWithouttashkeel' => $this->textWithouttashkeel,
            'audio' => $this->audio,
        ];
    }
}
