<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ClientResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
       // return parent::toArray($request);

         return [   
                    'id'=>$this->id,
                    'name'=> $this->name,
                    'address'=> $this->address,
                    'state' => $this->state,
                    'city' =>$this->city,
                    'country'=>$this->country,
                    'number'=> $this->number,
                    'rfc'=> $this->rfc,
                    'email'=>$this->email,
                    'contacts'=> new ContactCollection($this->clientcontacts),
                ];
    }
}
