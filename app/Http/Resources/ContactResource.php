<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ContactResource extends JsonResource
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
                    'name'=> $this->name,
                    'phones'=> $this->clientphonenumbers ,
                    'emails'=> $this->clientemails,
                    
                ];
    }
}
