<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PaysPartenersRessource extends JsonResource
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
            "id" => $this->id,
            "id_pays"=>$this->pays->id,
            "code_pays"=>$this->pays->code_pays,
            "fr"=>$this->pays->fr,
            "en"=>$this->pays->en
        ];
    }
}
