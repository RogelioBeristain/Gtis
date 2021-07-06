<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    
    public function toArray($request)
    {   //(!empty(App\User::find(1)->roles->first()->name))? App\User::find(1)->roles->first()->name: 'Sin Rol' 
        return [    'name'=> $this->name,
                    'email'=> $this->email,
                    'url_photo' => $this->url_photo,
                    'url_firm' =>$this->url_path,
                    'role' => (!empty($this->roles->first()->name))? $this->roles->first()->name : null,
                    'prefix'=> $this->prefix,
                    'cargo'=> $this->cargo,
                    'grado'=> $this->grado,
                ];
    }
}
