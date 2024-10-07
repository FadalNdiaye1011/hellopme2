<?php

namespace App\Http\Resources\api;

use Illuminate\Http\Resources\Json\JsonResource;

class ActeurFinanceResource extends JsonResource
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
            'libelle' => $this->libelle,
            'declaration' => $this->declaration,
            'pays'=>$this->pays_partners->pays,
            'ville'=>$this->ville,
            'website'=>$this->website,
            'logo' => $this->photo,
            'contacts' => ContactResource::collection($this->contacts),
            'services' => ServiceResource::collection($this->services),
        ];
    }
}
