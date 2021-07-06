<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Wholesalercontact extends Model
{
    //

    public function wholesaler()
    {
        return $this->belongsTo(Wholesaler::class);
    }
    public function wholesalerphonenumbers()
    {
        return $this->hasMany(Wholesalerphonenumber::class);
    }
    public function wholesaleremails()
    {
        return $this->hasMany(Wholesaleremail::class);
    }
}
