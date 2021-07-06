<?php

namespace App\Entities;
use App\User;
use App\Entities\Aplication;
use App\Entities\Warranty;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    //

   
    protected $guarded  = ['_token'];
    public function rates()
    {
        return $this->hasMany(Rate::class);
    }

    public function clientcontacts()
    {
        return $this->hasMany(Clientcontact::class);
    }

      public function user()
    {
        return $this->hasOne(User::class);
    }

       public function warranties()
    {
        return $this->hasMany(Warranty::class);
    }
       public function aplications()
    {
        return $this->hasMany(Aplication::class);
    }
  


}
