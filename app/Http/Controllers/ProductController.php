<?php

namespace App\Http\Controllers;
use App\Entities\Product;
use App\Entities\Wholesaler;
use App\Entities\Manufacturer;
use Illuminate\Http\Request;
use App\Http\Resources\ProductCollection;

class ProductController extends Controller
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
      
        $products=new ProductCollection(Product::orderBy('id','DESC')->get());
     

            return $products;
        }else{
        $products= Product::orderBy('id','DESC')->get();

        // $rates= Rate::orderBy('id','DESC')->get();
        return view('product.index',compact('products'));
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

        $products=json_encode(Product::all());
     

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

        $wholesalers= Wholesaler::all();
        $manufacturers= Manufacturer::all();
        return view('product.create',compact('wholesalers','manufacturers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'article' => 'required',
            'description' => 'required',
            'partnumber' => 'required',
            'model' => 'required',
            'manufacturerId' => 'required',
            'wholesalerId' => 'required',
            'cost' => 'required',
            'shipping' => 'required'
        ]);


        $product = new Product();
        $product->article= request('article');//1
        $product->description = request('description');
        $product->partnumber= request('partnumber');
        $product->code = request('code');
        $product->model = request('model');
        $product->manufacturer_id=request('manufacturerId');
        $product->wholesaler_id= request('wholesalerId');
        $product->stock=request('stock');
        $product->cost = request('cost');
        $product->shipping = request('shipping'); //10
    
        $product->price = $product->shipping + $product->cost;
        
        $wholesaler=Wholesaler::find($product->wholesaler_id);
        $manufacturer=Manufacturer::find($product->manufacturer_id);
    
      //  dd($product->manufacturer_id);
 
        $product->save();
       $wholesaler->products()->save($product);

        $manufacturer->products()->save($product);
 
        return redirect('/product');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        $product= Product::findOrFail($id);
     

        if($request->ajax()){
            $product=json_encode($product);
            
            return $product;
        }else{
            

            return view('product.show',compact('product'));
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
        $product= Product::findOrFail($id);
        $wholesalers= Wholesaler::all();
        $manufacturers= Manufacturer::all();
        return view('product.edit',compact('product','manufacturers','wholesalers'));
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
            'article' => 'required',
            'description' => 'required',
            'partnumber' => 'required',
            'model' => 'required',
            'manufacturerId' => 'required',
            'wholesalerId' => 'required',
            'stock' => 'required',
            'cost' => 'required',
            'shipping' => 'required'
        ]);

        $product= Product::findOrFail($id) -> update($request ->all());
        return redirect()->route('product.index')-> with('success','Product updated successfully');

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
        $product= Product::findOrFail($id);
        $product-> delete();
        return redirect()-> route('product.index')-> with('success','Product deleted successfully');
    }

     public function count(Request $request){
         if($request->ajax()){
            

           return response()->json(['data'=> "ok",'total'=>count(Product::all()) ]);
        
        }
        
    }
}
