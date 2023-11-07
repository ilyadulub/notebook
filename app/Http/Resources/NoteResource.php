<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NoteResource extends JsonResource
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
            'full_name' => $this->full_name,
            'company' => $this->company,
            'phone' => '+7' . $this->phone,
            'email' => $this->email,
            'birthday' => $this->birthday
                ? $this->birthday->format('Y-m-d')
                : $this->birthday,
            'photo_uri' => $this->photo
                ? asset('images' . DIRECTORY_SEPARATOR . $this->photo)
                : null,
        ];
    }
}
