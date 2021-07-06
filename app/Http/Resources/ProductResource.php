<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
                    'id'=>$this->id,
                    'description'=> $this->description,
                    'model'=> $this->model,
                    'code' => $this->code,
                    'price' =>number_format($this->price,2),
                    'article' => $this->article,
                    'partnumber'=> $this->partnumber,
                    'stock'=> $this->stock,
                    'url_image'=> $this->url_image,
                ];
    }
}
