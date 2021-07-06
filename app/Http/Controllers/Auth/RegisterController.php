<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Entities\Client;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

use Illuminate\Support\Facades\Mail;

use App\Mail\RegisterUser;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
           $user= User::create([
            'name' => $data['name'],
            'email' => $data['email'],          
            'password' => Hash::make($data['password']),
        ]);

        
 
            $client = new Client;
            $client->name=$data['name'];
            $client->email = $data['email'];
            
            $client->save();
            $user->client_id= $client->id;
            $user->save();
            
            $user->client()->associate($client);

            
           $mensaje = array(
                'email'=>$data['email'],
                'client'=>$user,
                'subject'=>'Nuevo registo de cliente',
                'bodyMessage'=> $data['email'],
                'a_file'=> []
            );


        Mail::to("rogelio26.dev@gmail.com")->send(new RegisterUser($mensaje));
        
        return $user;
    }
}
