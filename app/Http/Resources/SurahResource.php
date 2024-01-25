<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SurahResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $name = 'name_ar';
        $name_translation = 'name_ar';

        if(request()->has('lang') && in_array(request('lang'), ['en']))
        {
            $name = 'name_'.request('lang');
            $name_translation = 'name_'.request('lang').'_translation';
        }

        return [
            'id' => $this->id,
            'number' => $this->number,
            'name' => $this->{$name},
            'name_translation' => $this->{$name_translation},
            'type' => $this->type,
            'first_page' => $this->getFirstPage(),
            'last_page' => $this->getLastPage(),
        ];
    }
}
