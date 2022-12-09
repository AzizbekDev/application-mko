<?php

namespace App\Http\Resources\Application;

use Illuminate\Http\Resources\Json\JsonResource;

class PersonalInfoResource extends JsonResource
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
            'serial_number'         => $this->serial_number,
            'pin'                   => $this->pin,
            'inn'                   => $this->inn,
            'name'                  => $this->name,
            'family_name'           => $this->family_name,
            'patronymic'            => $this->patronymic,
            'birth_date'            => $this->birth_date,
            'document_date'         => $this->document_date,
            'document_region'       => $this->document_region,
            'document_district'     => $this->document_district,
            'registration_region'   => $this->registration_region,
            'registration_district' => $this->registration_district,
            'registration_address'  => $this->registration_address,
            'live_address'          => $this->live_address,
            'gender'                => $this->gender,
            'status_message'        => $this->status_message,
            'updated_at'            => date_local_format($this->updated_at),
        ];
    }
}
