<?php

namespace App\Http\Controllers;
use App\Entities\Rate;
use App\Entities\Product;
use App\Entities\Client;
use App\Entities\Kit;
use App\Entities\Organization;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Mail\RateClient;


class RateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index','store']]);
        $this->middleware('permission:role-create', ['only' => ['create','store']]);
        $this->middleware('permission:role-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:role-delete', ['only' => ['destroy']]);
   
    }

  
    public function create()
    {
        //
        $products= Product::all();
        $kits= Kit::all();
        $clients= Client::all();
        $rate=Rate::lastRate();

        return view('rate.create', compact('products','clients','kits','rate'));
    }

    public function createvue()
    {
        
//        $products= Product::all();
//        $kits= Kit::all();
//        $clients= Client::all();
//        $rate=Rate::lastRate();

//        return view('rate.createvue', compact('products','clients','kits','rate'));
        return view('rate.createvue');
    }


   
        public function store(Request $request)
    {
        /**     
         *      Estos son los campos, o datos que se rquieren para generar el PDF y guardar una CORIZACION sin firma
         *      este codigo necesita ser optimizado aqui se esta hacindo un espagueti
         *     "clientId" => "4"
         *     "total" => "1751.136"
         *     "conceptos" => "[{"id":"79","total":1326,"description":"UPS Interactivo Smart751","price":"550.00","type":"product","cantidad":"2","discount":"0","utility":"2","shipping":"100" ▶"
         *     "validation" => "2020-03-31"
         *     "place_delivery" => "Donde el Cliente"
         *     "time_delivery" => "5 dias habiles"
         *     "guarantee" => "la que indique el fabricante"
         *     "pay_mode" => "Credito 15 dias"
         *     "type_currency" => "Pesos mexicanos" 
         */

       /*  $validatedData = $request->validate([
            'clientId' => 'required',
            'validation' => 'required',
            'place_delivery' => 'required',
            'time_delivery' => 'required',
            'guarantee' => 'required',
            'pay_mode' => 'required',
            'type_currency' => 'required',
            'conceptos' => 'required',
           
         
        ]); */

  
        $rate = new Rate();
        //$rate->client_id= request('clientId');  // 1
        $rate->validation = request('validation'); 
        $rate->place_delivery= request('place_delivery');
        $rate->time_delivery= request('time_delivery');
        $rate->guarantee=request('guarantee');
        $rate->pay_mode=request('pay_mode');
        $rate->type_currency=request('type_currency');
        $rate->total=request('total'); //9
        $rate->user_id= Auth::user()->id;

       

        $rate->pdf='cotizacion'.date('His').'.pdf';  
        
        $client=Client::find(request('clientId'));
        $client->rates()->save($rate);

         $conceptos= json_decode(request('conceptos')  )  ;
       
        $subtotal=0;
       
        foreach ($conceptos as $key => $value) {
            
            if($value->type=='product'){
                $p= Product::find($value->id);
                $value->description = $p->description;
            }
            if($value->type=='kit'){
                $p= Kit::find($value->id);
                $value->description = $p->description;
            }
            $specRate=array('quantity' => $value->cantidad ,'utility' =>$value->utility,'shipping' =>$value->shipping,'description' =>$value->description,'price' =>$value->price,'total' =>$value->total,'discount'=>$value->discount );
            $subtotal+=$value->total;
                
            if($value->type=='product'){
                $rate->products()->attach( $value->id ,$specRate  );
            }else if($value->type=='kit'){
                
                    $rate->kits()->attach($value->id, $specRate );
            } 

            }

            
            $rate->save();
       $rate->ratenumber= $rate->id ;

        /**
         * Aqui se esta utilizando a entidad organizacion para la informacion de la empresa
         */
        $organization=null;
        if(Organization::find(1)){
            $organization=Organization::find(1);
        }
        else{
            $organization= new Organization();
            $organization->save();
        }
        
        $iva=$subtotal*.16;
        $format_date_rate_validation= Carbon::parse($rate->validation)->locale('es')->isoFormat('DD [de] MMMM [del] YYYY');
       $data = [
            'client' => $client,
            'rate_validation' => $format_date_rate_validation ,
            'rate_date'=>Carbon::now()->isoFormat('D/MM/Y'),
            'rate'=> $rate,
            'rate_iva'=>$iva,
            'rate_subtotal'=>$subtotal,
            'conceptos'=> $conceptos, 
            'rate_user'=>$rate->user,//       aqui los datos para la firma 
            'organization'=>$organization
              ];

        $pdf = PDF::loadView('rate/pdf_view', $data)->save(public_path().'/cotizaciones/cotizacion'.date('His').'.pdf');
      
        return $pdf->stream();

        // $pdf = PDF::loadView('pdf_view', $data);  
        // return $pdf->download('Cotización.pdf');


    }

    public function saveAndSend(Request $request){
        if($request->ajax()){
            $rate = new Rate();
          
            $rate->validation = $request->input('inputs.vigencia'); 
            $rate->place_delivery=$request->input('inputs.entrega');
            $rate->time_delivery= $request->input('inputs.plazo');
            $rate->guarantee=$request->input('inputs.garantia');
            $rate->pay_mode=$request->input('inputs.pago');
            $rate->type_currency=$request->input('inputs.divisa');
            //$rate->total=$request->input('inputs.id'); //9
           

            $rate->user_id= Auth::user()->id;
            
            $client_id = $request->input('client.id');
            $value=isset($client_id);
            $rate_client;
         
            if($value){
                $rate_client = Client::find($client_id);
                $rate_client->rates()->save($rate);
            }else{
                $rate_client = new Client($request->input('client'));
                $rate_client->save();
                $rate_client->rates()->save($rate);
            }
            
            $rate->ratenumber= $rate->id ;
            $rate->pdf='cotizacion'.date('His').'.pdf';  
            // 
            $conceptos=json_decode(json_encode($request->input('conceptos')));;
         
            $subtotal=0;
            $iva=0;
            $total=0;
           
            
          
            foreach ($conceptos as $key => $concepto) {
                 $subtotal+=$concepto->total;
                if($concepto->type =='product'){
                    $p= Product::find($concepto->id);
                    $concepto->description = $p->description;
                    
                    $specRate=array(
                    'quantity' => $concepto->cantidad,
                    'utility' =>$concepto->utilidad,
                    'shipping' =>$concepto->envio,
                    'description' =>$concepto->description,
                    'price' =>$concepto->precio,
                    'total' =>$concepto->total,
                    'discount'=>$concepto->descuento );
                
                   

                     $rate->products()->attach( $concepto->id ,$specRate  );
                }
                if($concepto->type=='kit'){
                    $k= Kit::find($concepto->id);
                    $concepto->description = $k->description;
                    $specRate=array(
                    'quantity' => $k->cantidad,
                    'utility' =>$k->utility,
                    'shipping' =>$k->shipping,
                    'description' =>$k->description,
                    'price' =>$k->price,
                    'total' =>$k->total,
                    'discount'=>$k->discount );
                   
                    $rate->kits()->attach($concepto->id, $specRate );

                }

            }
            $iva=$subtotal*.16;
            $total=$subtotal+$iva;
            $rate->total=$total;
            $rate->save();

            $organization=null;
            if(Organization::find(1)){
                $organization=Organization::find(1);
            }
            else{
                $organization= new Organization();
                $organization->save();
            }

             $format_date_rate_validation= Carbon::parse($rate->validation)->locale('es')->isoFormat('DD [de] MMMM [del] YYYY');
        $data = [
            'client' => $rate_client,
            'rate_validation' => $format_date_rate_validation ,
            'rate_date'=>Carbon::now()->isoFormat('D/MM/Y'),
            'rate'=> $rate,
            'rate_iva'=>$iva,
            'rate_subtotal'=>$subtotal,
            'conceptos'=> $conceptos, 
            'rate_user'=>$rate->user,//       aqui los datos para la firma 
            'organization'=>$organization
              ];

       // $pdf = PDF::loadView('rate/pdf_view', $data)->save(public_path().'/cotizaciones//'.$rate->pdf );
        $pdf = PDF::loadView('rate/pdf_view', $data);
      
        $output = $pdf->output();
        file_put_contents('cotizaciones/'.$rate->pdf, $output);
        
       // return $pdf->stream();




            return response()->json(['data'=> "Ok",'url_pdf'=>$rate->pdf]);
        }

    }




    public function mailSend(Request $request){
        $value="No se envio el mensaje";
        $mensaje=[];
       
        
       
        $filesJSON=array();
        if(!empty(request('a_file'))){
             
            $mensaje = array(
                'email'=>request('client_email'),
                'subject'=>'Respuesta a solicitud de cotización',
                'user'=>Auth::user(),
                'bodyMessage'=> request('body'),
                'tel_number'=> request('tel_number'),
                'a_file'=> request('a_file')
            );
            $mensaje2 = array(
                'email'=>request('client_email'),
                'subject'=>'Cotización Generada y enviada',
                'user'=>Auth::user(),
                'bodyMessage'=> request('body'),
                'tel_number'=> request('tel_number'),
                'a_file'=> request('a_file')
            );
            Mail::to("rogelio26.dev@gmail.com")->send(new RateClient($mensaje2));

            Mail::to($mensaje["email"])->send(new RateClient($mensaje));

            $value="mensaje OK";
        }
        
        Storage::prepend('cotizaciones/'.Auth::user()->name.'/messages.log', request('body').'\n');
//      return $value;
//      return view('mails.demo_plain',compact('mensaje','value'));
        return back()->withStatus(__('Tu solicitud se envio correctamente'));
    }

    public function sendRate(Request $request){
        /**
         * El request debe contener los datos para el envio de la cotizacion
         * puede ser un json
         * con la url del pdf
         * datos del usuario que envia para la firma
         * y el cliente al que se enviara, o más emails
         * y puede o no contener un cuerpo del mensaje
         */

        if($request->ajax()){

            
        }




    }






    public function index()
    {
        //read
        $rates= Rate::orderBy('id','DESC')->get();
        //Role::orderBy('id','DESC')->paginate(5);

        return view('rate.index', compact('rates') );
    }

  
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
public function createVistaPrevia(Request $request){
        if($request->ajax()){
            $rate = new Rate();
          
            $rate->validation = $request->input('inputs.vigencia'); 
            $rate->place_delivery=$request->input('inputs.entrega');
            $rate->time_delivery= $request->input('inputs.plazo');
            $rate->guarantee=$request->input('inputs.garantia');
            $rate->pay_mode=$request->input('inputs.pago');
            $rate->type_currency=$request->input('inputs.divisa');
            //$rate->total=$request->input('inputs.id'); //9
           

            $rate->user_id= Auth::user()->id;
            
            $client_id = $request->input('client.id');
            $value=isset($client_id);
            $rate_client;
         
            if($value){
                $rate_client = Client::find($client_id);
              /*   $rate_client->rates()->save($rate); */
            }else{
                $rate_client = new Client($request->input('client'));
               /*  $rate_client->save();
                $rate_client->rates()->save($rate); */
            }
            
            $rate->ratenumber= $rate->id ;
            $name_pdf='cotizacion'.date('His');
            $rate->pdf=$name_pdf.'.pdf';  
            
            // 
            $conceptos=json_decode(json_encode($request->input('conceptos')));;
         
            $subtotal=0;
            $iva=0;
            $total=0;
           
            
          
            foreach ($conceptos as $key => $concepto) {
                 $subtotal+=$concepto->total;
               $specRate=array(
                    'quantity' => $concepto->cantidad,
                    'utility' =>$concepto->utilidad,
                    'shipping' =>$concepto->envio,
                    'description' =>$concepto->description,
                    'price' =>$concepto->precio,
                    'total' =>$concepto->total,
                    'discount'=>$concepto->descuento );

                if($concepto->type =='product'){
                    $p= Product::find($concepto->id);
                    $concepto->description = $p->description;
                    
                    /* $specRate=array(
                    'quantity' => $concepto->cantidad,
                    'utility' =>$concepto->utilidad,
                    'shipping' =>$concepto->envio,
                    'description' =>$concepto->description,
                    'price' =>$concepto->precio,
                    'total' =>$concepto->total,
                    'discount'=>$concepto->descuento );
                
                    */

                    // $rate->products()->attach( $concepto->id ,$specRate  );
                }
                if($concepto->type=='kit'){
                    $k= Kit::find($concepto->id);
                    $concepto->description = $k->description;
                   /*  $specRate=array(
                    'quantity' => $k->cantidad,
                    'utility' =>$k->utility,
                    'shipping' =>$k->shipping,
                    'description' =>$k->description,
                    'price' =>$k->price,
                    'total' =>$k->total,
                    'discount'=>$k->discount ); */
                   
                   // $rate->kits()->attach($concepto->id, $specRate );

                }

            }
            $iva=$subtotal*.16;
            $total=$subtotal+$iva;
            $rate->total=$total;
         

            $organization=null;
            if(Organization::find(1)){
                $organization=Organization::find(1);
            }
            else{
                $organization= new Organization();
                $organization->save();
            }

             $format_date_rate_validation= Carbon::parse($rate->validation)->locale('es')->isoFormat('DD [de] MMMM [del] YYYY');
        $data = [
            'client' => $rate_client,
            'rate_validation' => $format_date_rate_validation ,
            'rate_date'=>Carbon::now()->isoFormat('D/MM/Y'),
            'rate'=> $rate,
            'rate_iva'=>$iva,
            'rate_subtotal'=>$subtotal,
            'conceptos'=> $conceptos, 
            'rate_user'=>$rate->user,//       aqui los datos para la firma 
            'organization'=>$organization
              ];

        $pdf = PDF::loadView('rate/pdf_view', $data)->save(public_path().'/cotizaciones_test//'.$rate->pdf );
      // return $pdf->stream();




            return response()->json(['data'=> "Ok",'url_pdf'=>$rate->pdf]);
        }

    }
    public function verPDF(Request $request)
    {
        $rate = new Rate();
        $rate->client_id= request('clientId');  // 1
        $rate->validation = request('validation'); 
        $rate->place_delivery= request('place_delivery');
        $rate->time_delivery= request('time_delivery');
        $rate->guarantee=request('guarantee');
        $rate->pay_mode=request('pay_mode');
        $rate->type_currency=request('type_currency');
        $conceptos= json_decode(request('conceptos')  )  ;
        $rate->total=request('total'); //9
        $rate->user_id= Auth::user()->id;
        $client=Client::find($rate->client_id);

   
       
        $subtotal=0;
       
     foreach ($conceptos as $key => $value) {
            
        if($value->type=='product'){

            $p= Product::find($value->id);
            $value->description = $p->description;
        }

          if($value->type=='kit'){

                $p= Kit::find($value->id);
                $value->description = $p->description;
            }
        $specRate=array('quantity' => $value->cantidad ,'utility' =>$value->utility,'shipping' =>$value->shipping,'description' =>$value->description,'price' =>$value->price,'total' =>$value->total,'discount'=>$value->discount );
        $subtotal+=$value->total;
      

        }
     
       
      
         $organization=null;
        if(Organization::find(1)){
            $organization=Organization::find(1);
        }
        else{
            $organization= new Organization();
            $organization->save();
        }
   $rate->ratenumber= $rate->id ;

        $iva=$subtotal*.16;
        $format_date_rate_validation= Carbon::parse($rate->validation)->locale('es')->isoFormat('DD [de] MMMM [del] YYYY');
      $data = [
            'client' => $client,
            'rate_validation' => $format_date_rate_validation ,
            'rate_date'=>Carbon::now()->isoFormat('D/MM/Y'),
            'rate'=> $rate,
            'rate_iva'=>$iva,
            'rate_subtotal'=>$subtotal,
            'conceptos'=> $conceptos, 
            'rate_user'=>$rate->user,//       aqui los datos para la firma 
            'organization'=>$organization
              ];

             // Gti2019Sep
             //ver
     $pdf = PDF::loadView('rate/pdf_view', $data)->save(public_path().'/cotizaciones_test/cotizacion'.date('His').'.pdf');
        

         
            
            return $pdf->stream();

         // $pdf = PDF::loadView('pdf_view', $data);  
         // return $pdf->download('Cotización.pdf');


    }

  

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $clients= Client::all();
        $rate= Rate::findOrFail($id);
        $products= Product::all();
        $kits=Kit::all();
        $rateProducts=$rate->products;
     
        $rateKits=$rate->kits;
     
        return view('rate.edit',compact('rate','kits','products','rateProducts','rateKits','clients'));
    }

 
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'clientId' => 'required',
            'validation' => 'required',
            'place_delivery' => 'required',
            'time_delivery' => 'required',
            'guarantee' => 'required',
            'pay_mode' => 'required',
            'type_currency' => 'required',
            'conceptos' => 'required',
         
        ]);
           
        $rate = Rate::find($id);
     
 
        $rate->client_id= request('clientId');  // 1
        $rate->validation = request('validation'); 
        $rate->place_delivery= request('place_delivery');
        $rate->time_delivery= request('time_delivery');
        $rate->guarantee=request('guarantee');
        $rate->pay_mode=request('pay_mode');
        $rate->type_currency=request('type_currency');
        $conceptos= json_decode(request('conceptos')  )  ;
        $rate->total=request('total'); 
      

        $conceptos= json_decode(request('conceptos') )  ;
            
        $rate->pdf='cotizacion'.date('His').'.pdf';    
        $rate->save();
        $rate->ratenumber= $rate->id;//10
        $client=Client::find($rate->client_id);

       $client->rates()->save($rate);
        $subtotal=0;
        
        $productsIds = array();
        $kitsIds = array(); 

      $rate->products()->sync($productsIds);
        $rate->kits()->sync($kitsIds);

      //  error_log($rate->products);
       
        foreach ($conceptos as $value) {
            

            if($value->type=='product'){

                $p= Product::find($value->id);
                $value->description = $p->description;
            }
              if($value->type=='kit'){

                $p= Kit::find($value->id);
                $value->description = $p->description;
            }
            $subtotal+=$value->total;
           
                 $specRate=array('quantity' => $value->cantidad ,'utility' =>$value->utility,'shipping' =>$value->shipping,'description' =>$value->description,'price' =>$value->price,'total' =>$value->total,'discount'=>$value->discount );
         
                 if($value->type=='product'){
     
                 $rate->products()->attach($value->id ,$specRate);
          }else if($value->type=='kit'){
               $rate->kits()->attach($value->id ,$specRate); 
          
     
                 }
             }
     $organization=null;
        if(Organization::find(1)){
            $organization=Organization::find(1);
        }
        else{
            $organization= new Organization();
            $organization->save();
        }
             $rate->ratenumber=$rate->id;
        $iva=$subtotal*.16;
      $format_date_rate_validation= Carbon::parse($rate->validation)->locale('es')->isoFormat('DD [de] MMMM [del] YYYY');
      //asort($conceptos[descripcion]);
     $data = [
            'client' => $client,
            'rate_validation' => $format_date_rate_validation ,
            'rate_date'=>Carbon::now()->isoFormat('D/MM/Y'),
            'rate'=> $rate,
            'rate_iva'=>$iva,
            'rate_subtotal'=>$subtotal,
            'conceptos'=> $conceptos, 
            'rate_user'=>$rate->user,//       aqui los datos para la firma 
            'organization'=>$organization
              ];

              //update
             $pdf = PDF::loadView('rate/pdf_view', $data)->save(public_path().'/cotizaciones//'.$rate->pdf);
        
          return $pdf->stream();
        

    }

    

    public function vistaPrevia($cotizacion){

         return view('rate.preview_pdf', compact('cotizacion') );
        
    }

        public function editJson($id)
    {
        //

        $rate= Rate::findOrFail($id);
        $products= Product::all();
        $rateKits=$rate->kits;
        $rateProducts=$rate->products;
       
        return compact('rateProducts','rateKits');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $rate= Rate::findOrFail($id);
        $rate-> delete();
        return redirect()-> route('rate.index')
        -> with('success','Rate deleted successfully');
    }

    public function count(Request $request){
         if($request->ajax()){
            

           return response()->json(['data'=> "ok",'total'=>count(Rate::all() ) ]);
        
        }
        
    }

}
