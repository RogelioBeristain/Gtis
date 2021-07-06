<?php

namespace App\Http\Controllers;
use App\Entities\Remission;
use Illuminate\Http\Request;

class RemissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //read
        $remissions= Remission::orderBy('id','DESC')->get();
       
        return view('remission.index', compact('remissions') );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //


        if($request->ajax()){
            $rate =  Rate::find($request->rate_id);
            $remision= new Remission();
            $remision->place_delivery= $rate->place_delivery; //1
            $remision->time_delivery = $rate->time_delivery;
            $remision->user_id= $rate->user_id;
            $remision->client_id =  $rate->client_id;
            $remision->remission_number= $rate->ratenumber;
            $remision->total= $rate->total;
            $remision->pdf='Remision'.date('His').'.pdf';  //7
           
            $remision->save();

            $client_id = $rate->client_id;
           
          
        
            
         
            $subtotal=0;
            $iva=0;
            $total=0;
           
            $rateProducts=$rate->products;
     
            $rateKits=$rate->kits;
          
            foreach ($rateProducts as $key => $concepto) {
          
             
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
                
                    $subtotal+=$concepto->total;

                     $remision->products()->attach( $concepto->id ,$specRate  );
               
               

            }


            foreach ($rateKits as $key => $concepto) {
          
               
                    $k= Kit::find($concepto->id);
                    $concepto[description] = $k->description;
                    $specRate=array(
                    'quantity' => $k->cantidad,
                    'utility' =>$k->utility,
                    'shipping' =>$k->shipping,
                    'description' =>$k->description,
                    'price' =>$k->price,
                    'total' =>$k->total,
                    'discount'=>$k->discount );
                    $subtotal+=$k->total;
                    $remision->kits()->attach($concepto->id, $specRate );
    
              
               

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

             $format_date_remission_validation= Carbon::parse($rate->validation)->locale('es')->isoFormat('DD [de] MMMM [del] YYYY');
        $data = [
            'client' => $rate_client,
            'remission_validation' => $format_date_remission_validation ,
            'remission_date'=>Carbon::now()->isoFormat('D/MM/Y'),
            'remission'=> $remission,
            'remission_iva'=>$iva,
            'remission_subtotal'=>$subtotal,
            'conceptos'=> $conceptos, 
            'remission_user'=>$remission->user,//       aqui los datos para la firma 
            'organization'=>$organization
              ];

              $pdf = PDF::loadView('remission/pdf_view', $data);
      
              $output = $pdf->output();
              file_put_contents('notas_remision/'.$rate->pdf, $output);
        
       // return $pdf->stream();




            return response()->json(['data'=> "Ok",'url_pdf'=>$rate->pdf]);
        }
    }
    public function saveAndSend(Request $request){

        
        if($request->ajax()){
            $rate =  Rate::find($request->rate_id);
            $remision= new Remission();
            $remision->place_delivery= $rate->place_delivery; //1
            $remision->time_delivery = $rate->time_delivery;
            $remision->user_id= $rate->user_id;
            $remision->client_id =  $rate->client_id;
            $remision->remission_number= $rate->ratenumber;
            $remision->total= $rate->total;
            $remision->pdf='Remision'.date('His').'.pdf';  //7
           
            $remision->save();

            $client_id = $rate->client_id;
           
          
        
            
         
            $subtotal=0;
            $iva=0;
            $total=0;
           
            $rateProducts=$rate->products;
     
            $rateKits=$rate->kits;
          
            foreach ($rateProducts as $key => $concepto) {
          
             
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
                
                    $subtotal+=$concepto->total;

                     $remision->products()->attach( $concepto->id ,$specRate  );
               
               

            }


            foreach ($rateKits as $key => $concepto) {
          
               
                    $k= Kit::find($concepto->id);
                    $concepto[description] = $k->description;
                    $specRate=array(
                    'quantity' => $k->cantidad,
                    'utility' =>$k->utility,
                    'shipping' =>$k->shipping,
                    'description' =>$k->description,
                    'price' =>$k->price,
                    'total' =>$k->total,
                    'discount'=>$k->discount );
                    $subtotal+=$k->total;
                    $remision->kits()->attach($concepto->id, $specRate );
    
              
               

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

             $format_date_remission_validation= Carbon::parse($rate->validation)->locale('es')->isoFormat('DD [de] MMMM [del] YYYY');
        $data = [
            'client' => $rate_client,
            'remission_validation' => $format_date_remission_validation ,
            'remission_date'=>Carbon::now()->isoFormat('D/MM/Y'),
            'remission'=> $remission,
            'remission_iva'=>$iva,
            'remission_subtotal'=>$subtotal,
            'conceptos'=> $conceptos, 
            'remission_user'=>$remission->user,//       aqui los datos para la firma 
            'organization'=>$organization
              ];

              $pdf = PDF::loadView('remission/pdf_view', $data);
      
              $output = $pdf->output();
              file_put_contents('notas_remision/'.$rate->pdf, $output);
        
       // return $pdf->stream();




            return response()->json(['data'=> "Ok",'url_pdf'=>$rate->pdf]);
        }

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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
    }
}
