<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VersionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'numero_appstore' => $this->numero_appstore,
            'numero_playstore' => $this->numero_playstore,
            'url_appstore' => $this->url_appstore,
            'url_playstore' => $this->url_playstore,
            'motif_appstore' => $this->motif_appstore,
            'motif_playstore' => $this->motif_playstore,
            'titre_appstore' => $this->titre_appstore,
            'titre_playstore' => $this->titre_playstore,
            'obligatoire_appstore' => $this->obligatoire_appstore,
            'obligatoire_playstore' => $this->obligatoire_playstore,
            'deleted_at' => $this->deleted_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
