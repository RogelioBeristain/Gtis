<?php

namespace App\Http\Controllers;
use App\Entities\Client;
use App\User;
use App\Entities\Aplication;
use App\Entities\Warranty;
use App\Entities\Clientcontact;
use App\Entities\Clientemail;
use App\Http\Resources\ClientResource;
use App\Http\Resources\ClientCollection;
use App\Entities\Clientphonenumber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ProductRates;
use App\Mail\ProductWarranty;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Auth;
class ClientController extends Controller
{     
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index','store']]);
        $this->middleware('permission:role-create', ['only' => ['create','store']]);
        $this->middleware('permission:role-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:role-delete', ['only' => ['destroy']]);
   
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

         if($request->ajax()){
         
            return new ClientCollection(Client::orderBy('id','DESC')->get());

         }else{
        $clients= Client::orderBy('id','DESC')->get();
        return view('client.index',compact('clients') )->with('i',(request()->input('page',1) - 1) * 5);
         }
    
    }

    


    public function create()
    {
        return view('client.create');
    }
       public function home()
    {
        return view('client.home');
    }

       public function mesa()
    {
        return view('client.mesa');
    }

    public function destroy($id)
    {
        $client= Client::findOrFail($id);
        $client-> delete();
        return redirect()-> route('client.index')-> with('success','Product deleted successfully');
    }

    public function store(Request $request)
    {
       $validatedData = $request->validate([
        'nameC' => 'required',
        'address' => 'required',
        'country' => 'required',
        'state' => 'required',
        'city' => 'required',
        'number' => 'required',
        'rfc' => 'required',
        'email' => 'required',
        'contacts' => 'required', 
        ]);

        
        $client = new Client();
 
        $client->name = request('nameC');//1
        $client->address = request('address');
        $client->country = request('country');
        $client->state = request('state');
        $client->city = request('city');
        $client->number = request('number');
        $client->rfc = request('rfc');
        $client->email = request('email');//8
        $client->save();
        $contacts=json_decode(request('contacts'));//9

        foreach ($contacts as $key =>$contact) {
            
//          dd($value->pivot);
//          $auxcontact=array('name'=>$value->name);
            $clientContact = new Clientcontact();
            $clientContact->name=$contact->name;
            $clientContact->client_id=$client->id;
            $clientContact->save();
            $clientContact->client()->associate($client)->save();
//          $client = $client->clientcontacts()->save($clientContact);

            foreach ($contact->emails as $key => $email) {
                $clientemail = new Clientemail();
                $clientemail->email=$email->email;
                $clientemail->clientcontact_id=$clientContact->id;
                $clientemail->save();
            }
            foreach ($contact->numbers as $key => $number) {
                $clientnumber = new Clientphonenumber();
                $clientnumber->number=$number->number;
                $clientnumber->clientcontact_id=$clientContact->id;
                $clientnumber->save();
            }
        }
        
      
        return redirect('/client');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $client= Client::findOrFail($id);
//      dd($client);
        return view('client.show',compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $client= Client::findOrFail($id);        
        $contacts=$client->clientcontacts;
        $emailscount=0;
        $numberscount=0;
        foreach ($contacts as $key => $contact) {
            $numberscount+=$contact->clientphonenumbers->count();
            $emailscount+=$contact->clientemails->count();
        }
        return view('client.edit',compact('client','contacts','emailscount','numberscount'));
    }

    public function editJson($id)
    {
        $client= Client::findOrFail($id);
        $contactsJson=array();
        $emailsJson=array();
        $numbersJson=array();
        $contacts=$client->clientcontacts;
        foreach ($contacts as $key => $contact) {
            $numbers=$contact->clientphonenumbers;
            if($numbers){
                $contact['emails'] = $numbers;
            }
            $emails=$contact->clientEmails;
            if($emails){
                $contact['emails'] = $numbers;
            }
        }
        return compact('contacts');
    }
 

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {        
       $validatedData = $request->validate([
            'nameC' => 'required',
            'address' => 'required',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
            'number' => 'required',
            'rfc' => 'required',
            'email' => 'required',
            'contacts' => 'required',]
        );
        $client = Client::findOrFail($id);
        $client->name = request('nameC');
        $client->address = request('address');
        $client->country = request('country');
        $client->state = request('state');
        $client->city = request('city');
        $client->number = request('number');
        $client->rfc = request('rfc');
        $client->email = request('email');
        $client->save();
        $contacts=json_decode(request('contacts'));
        $client->clientcontacts()->delete();
        foreach ($contacts as $key =>$contact) {
//          dd($value->pivot);
//          $auxcontact=array('name'=>$value->name);
            $clientContact = new Clientcontact();
            $clientContact->name=$contact->name;
            $clientContact->client_id=$client->id;
            $clientContact->save();
            $clientContact->client()->associate($client)->save();
//          $client = $client->clientcontacts()->save($clientContact);
            foreach ($contact->emails as $key => $email) {
                $clientemail = new Clientemail();
                $clientemail->email=$email->email;
                $clientemail->clientcontact_id=$clientContact->id;
                $clientemail->save();
            }

            foreach ($contact->numbers as $key => $number) {
                $clientnumber = new Clientphonenumber();
                $clientnumber->number=$number->number;
                $clientnumber->clientcontact_id=$clientContact->id;
                $clientnumber->save();
            }
        }
        return redirect('/client')-> with('success','Product updated successfully');
    }


    public function send(Request $request){
        $value="No se envio el mensaje";
        $mensaje=[];
        $userAux= $request->user();
        $user =User::find($userAux->id);
        $client= $user->client;
        $aplication = new Aplication();
        $aplication->body =  request('body');//1
        $aplication->tel_number = request('tel_number');
        $client->aplications()->save($aplication);
        $filesJSON=array();
        if(!empty(request('a_file'))){
             foreach(request('a_file') as $filePath){
                    $file=$filePath;
                    $filename  =$file->getClientOriginalName();
//                  $filename= $filename.''.time();
                    $extension = $file->getClientOriginalExtension();
                    $picture   = date('His').'-'.$filename;
//                  $file->move(public_path('solicitudes'), $picture);
                    $url= Storage::disk('uploads')->put($picture, file_get_contents($file));
//                  dd($url);
                    $fileObj =(object) [
                        'name' => $picture,
                        'type' => $extension,
                        'user_id'=> $request->user()->id
                    ];
                    array_push($filesJSON,$fileObj);
//                  $url = $file->storeAs('public', $fileName);
//                  $url =$picture;
            }
            $mensaje = array(
                'email'=>request('client_email'),
                'client'=>Auth::user(),
                'subject'=>'Nueva Solicitud de Cotización',
                'bodyMessage'=> request('body'),
                'tel_number'=> request('tel_number'),
                'a_file'=> request('a_file')
            );
            Mail::to("rogelio26.dev@gmail.com")->send(new ProductRates($mensaje));
           // Mail::to("ventas@gtis.mx")->send(new ProductRates($mensaje));
            $value="mensaje OK";
        }else{
            $mensaje  = array(
                'email'=>request('client_email'),
                'client'=>Auth::user(),
                'subject'=>'Nueva Solicitud de Cotización',
                'bodyMessage'=> request('body'),
                'tel_number'=> request('tel_number'),
                'a_file'=> null
            );
            Mail::to("rogelio26.dev@gmail.com")->send(new ProductRates($mensaje));
          //  Mail::to("ventas@gtis.mx")->send(new ProductRates($mensaje));
            $value="mensaje OK2";
        }
        $aplication->files= json_encode($filesJSON);
        $aplication->save();
        Storage::prepend('cotizaciones/'.Auth::user()->name.'/messages.log', request('body').'\n');
//      return $value;
//      return view('mails.demo_plain',compact('mensaje','value'));
        return back()->withStatus(__('Tu solicitud se envio correctamente'));
    }


      public function warranty(Request $request){
        $value="No se envio el mensaje";
        $mensaje=[];
        $userAux=$request->user();
        $user =User::find($userAux->id);
        $client= $user->client;
        $wa = new Warranty();
        $wa->description =  request('body');
        $wa->user_name =  request('user_name');
        $wa->tel_number =  request('tel_number');
        $wa->manufacturer_name =  request('manufacturer');
        $wa->model =  request('model');
        $wa->code =  request('code');
        $wa->serial_number =  request('serial_number');
        $wa->date_pay =  request('date_pay');  
        $client->warranties()->save($wa);
        $filesJSON=array();
        
        if(!empty(request('a_file'))){
            foreach(request('a_file') as $filePath){
                $file=$filePath;
                $filename  =$file->getClientOriginalName();
//              $filename= $filename.''.time();
                $extension = $file->getClientOriginalExtension();
                $picture   = date('His').'-'.$filename;
//              $file->move(public_path('solicitudes'), $picture);
                $url= Storage::disk('uploads')->put($picture, file_get_contents($file));
//              dd($url);
                $fileObj =(object) [
                    'name' => $picture,
                    'type' => $extension,
                    'user_id'=> $request->user()->id
                ];
                array_push($filesJSON,$fileObj);
//              $url = $file->storeAs('public', $fileName);
//              $url =$picture;
            }

            $mensaje = array(
                'email'=>request('client_email'),
                'client'=>Auth::user(),
                'subject'=>'Nueva Solicitud de Garantia',
                'bodyMessage'=> request('body'),
                'manufacturer'=> request('manufacturer'),
                'model' => request('model'),
                'serial_number'=> request('serial_number'),
                'code'=> request('code'),
                'date_pay'=> request('date_pay'),
                'tel_number'=> request('tel_number'),
                'a_file'=> request('a_file')
            );

            Mail::to("rogelio26.dev@gmail.com")->send(new ProductWarranty($mensaje));
           // Mail::to("ventas@gtis.mx")->send(new ProductWarranty($mensaje));
            $value="mensaje OK";

        }else{
            $mensaje  = array(
                'email'=>request('client_email'),
                'client'=>Auth::user(),
                'subject'=>'Nueva Solicitud de Garantia',
                'bodyMessage'=> request('body'),
                'manufacturer'=> request('manufacturer'),
                'model' => request('model'),
                'serial_number'=> request('serial_number'),
                'code'=> request('code'),
                'date_pay'=> request('date_pay'),
                'tel_number'=> request('tel_number'),
                'a_file'=> null
            );

            Mail::to("rogelio26.dev@gmail.com")->send(new ProductWarranty($mensaje));
           // Mail::to("ventas@gtis.mx")->send(new ProductWarranty($mensaje));
            $value="mensaje OK2";
        }
        $wa->files= json_encode($filesJSON);
        $wa->save();
        Storage::prepend('cotizaciones/'.Auth::user()->name.'/messages.log', request('body').'\n');
//      return $value;
        return back()->withStatus(__('Tu solicitud se envio correctamente'));
    }


    public function count(Request $request){
         if($request->ajax()){
            

           return response()->json(['data'=> "ok",'total'=>count(Client::all()) ]);
        
        }
        
    }
}
