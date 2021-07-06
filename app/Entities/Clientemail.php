<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Clientemail extends Model
{
    public function clientcontact()
    {
        return $this->belongsTo(Clientcontact::class);
    }
}
