<?php

namespace App\Http\Controllers;
use App\Entities\Manufacturer;
use Illuminate\Http\Request;
use App\Http\Resources\ManufacturerCollection;

class ManufacturerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

 
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['store']]);
        $this->middleware('permission:role-create', ['only' => ['create','store']]);
        $this->middleware('permission:role-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:role-delete', ['only' => ['destroy']]);
   
    }
    public function index(Request $request)
    {
        

         if($request->ajax()){
          
            return new ManufacturerCollection(Manufacturer::orderBy('name')->get());
        }
        else{
            $manufacturers= Manufacturer::orderBy('id','DESC')->get();
            return view('manufacturer.index',compact('manufacturers'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view('manufacturer.create');
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

        $validatedData = $request->validate([
            'name' => 'required',
            'number' => 'required',
            'email' => 'required'  
        ]);

        $manufacturer = new Manufacturer();
 
        $manufacturer->name = request('name');//1
        $manufacturer->number = request('number');
        $manufacturer->email = request('email');
   

 
        $manufacturer->save();
 
        return redirect('/manufacturer');
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

        $manufacturer= Manufacturer::findOrFail($id);

        return view('manufacturer.show',compact('manufacturer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $manufacturer= Manufacturer::findOrFail($id);
        return view('manufacturer.edit',compact('manufacturer'));
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
            'name' => 'required',
            'number' => 'required',
            'email' => 'required'  
        ]);
        $manufacturer= Manufacturer::findOrFail($id) -> update($request ->all()) ;

  

        return redirect()->route('manufacturer.index')
        -> with('success','Wholesaler updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $manufacturer= Manufacturer::findOrFail($id);
        $manufacturer-> delete();
        return redirect()-> route('manufacturer.index')
        -> with('success','Manufacturer deleted successfully');
    }

     public function count(Request $request){
         if($request->ajax()){
            

           return response()->json(['data'=> "ok",'total'=>count(Manufacturer::all()) ]);
        
        }
        
    }
}
