<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use App\User;
class Aplication extends Model
{
      public function user()
    {
        return $this->belongsTo(User::class);
    }
}
