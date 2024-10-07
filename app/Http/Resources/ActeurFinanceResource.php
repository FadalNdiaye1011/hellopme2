<?php

namespace App\Http\Resources;

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
            'services' => $this->services->map(function ($service) {
                return [
                    'id' => $service->id,
                    'libelle' => $service->libelle,
                    'commentaire' => $service->pivot->commentaire ?? null, // Récupérer le commentaire du pivot
                ];
            }),
            'pays' =>new PaysPartenersRessource($this->pays_partners),
            'contacts' => $this->contacts,
            'typeFinance' =>$this->typeFinance,
        ];
    }
}
