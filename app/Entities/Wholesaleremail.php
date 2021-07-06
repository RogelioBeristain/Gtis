<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Wholesaleremail extends Model
{
    public function wholesalercontact()
    {
        return $this->belongsTo(wholesalercontact::class);
    }
}
