<?php

namespace App\Http\Controllers;
use App\Entities\Kit;
use App\Entities\Product;
use Illuminate\Http\Request;
use App\Http\Resources\KitCollection;
class KitController extends Controller
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
        //
        if($request->ajax()){

           $kits=new KitCollection(Kit::orderBy('id','DESC')->get());  
           return $kits;
        }else{

        $kits= Kit::orderBy('id','DESC')->get();
        return view('kit.index',compact('kits'));
        }


    }

    public function find(Request $request,$code)
    {
        //
       /* $products= Product::lastest()->paginate(5);

        return view('product.index',compact('products') )
            ->with('i',(request()->input('page',1) - 1) * 5);
   */

       if($request->ajax()){
        //$code=request('keyname');

        $products=json_encode(Kit::all());
     

            return $products;
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
        $products= Product::all();
        return view('kit.create',compact('products'));
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
        'description' => 'required',
        'title' => 'required',
        'price' => 'required',
        'products' => 'required'
     
        
    ]);

        $kit = new Kit();
 
        $kit->description = request('description');//1
        $kit->title = request('title');
        $kit->price = request('price');
        $products=json_decode(request('products'));//4


       // dd($request);
      
        
    
    
        $kit->save();

        foreach ($products as $key => $value) {
            # code...
           // dd($value );
    
 
        # dd($value );
 
           #$roleId, ['expires' => $expires]
           $kit->products()->attach([ $value->id ] );
           
          
        }
  
        return redirect('/kit');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        //
        $kit=Kit::findOrFail($id);
        $data['kit']=Kit::findOrFail($id);

        
        if($request->ajax()){

            $kit=Kit::findOrFail($id);
            $kit=json_encode($kit);
            
            return $kit;
        }else{
        $data['products']=$kit->products;

        return view('kit.show',$data);
        }

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

        $kit= Kit::findOrFail($id);
        $products= Product::all();
        $productsK=$kit->products;
        return view('kit.edit',compact('kit','products'));
    }

    public function editJson($id)
    {
        //

        $kit= Kit::findOrFail($id);
        $products= Product::all();
        $productsK=$kit->products;
        return compact('productsK');
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
            'description' => 'required',
            'title' => 'required',
            'price' => 'required',
            'products' => 'required'
         
            
        ]);
           
        $kit = Kit::find($id);
 
        $kit->description = request('description');
        $kit->title = request('title');
        $kit->price=$kit->getPrice();
        $products=json_decode(request('products'));

       // dd($products);

    
    
        $kit->save();

        $productsIds= array();

        foreach ($products as $key => $value) {
    
        # dd($value );
        array_push($productsIds, $value->id);
           #$roleId, ['expires' => $expires]


          // $kit->products()->sync([ $value->id ] );
           
          
        }

        $kit->products()->sync($productsIds);

        return redirect()->route('kit.index')
        -> with('success','Kit updated successfully');


         

  
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

        $kit= Kit::findOrFail($id);
        $kit-> delete();
        return redirect()-> route('kit.index')
        -> with('success','Kit deleted successfully');
    }

     public function count(Request $request){
         if($request->ajax()){
            

           return response()->json(['data'=> "ok",'total'=>count(Kit::all()) ]);
        
        }
        
    }
}
