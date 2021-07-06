<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Storage;
use App\Entities\Rate;
use App\Entities\Client;


class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
        * @var array
        */
    protected $fillable = [
        'name', 
        'email', 
        'password',
        'prefix', 
        'last_login_at',
        'last_login_ip',
        'last_login_user_agent',
        'client_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
        public function rates()
    {
        return $this->hasMany(Rate::class);
    }
     

    public function getUrlPathAttribute(){
        return asset(Storage::url($this->url_photo));
        //return $this->url_photo;
    }

      public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
