<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Clientcontact extends Model
{
    //

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
    public function clientphonenumbers()
    {
        return $this->hasMany(Clientphonenumber::class);
    }
    public function clientemails()
    {
        return $this->hasMany(Clientemail::class);
    }
}
