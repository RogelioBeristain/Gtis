<?php

namespace App\Http\Controllers;
use App\Entities\Wholesaler;
use Illuminate\Http\Request;

class WholesalerController extends Controller
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
    public function index()
    {
        //

        $wholesalers= Wholesaler::all();
        return view('wholesaler.index',compact('wholesalers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view('wholesaler.create');
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
            'code' => 'required'
        ]);
        $wholesaler = new Wholesaler();
 
        $wholesaler->name = request('name');
        $wholesaler->code = request('code');
   
 
        $wholesaler->save();
 
        return redirect('/wholesaler');
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

        $wholesaler= Wholesaler::findOrFail($id);

        return view('wholesaler.show',compact('wholesaler'));
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

        $wholesaler= Wholesaler::findOrFail($id);
        return view('wholesaler.edit',compact('wholesaler'));
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
        $validatedData = $request->validate([
            'name' => 'required',
            'code' => 'required'
        ]);
        
        $wholesaler= Wholesaler::findOrFail($id) -> update($request ->all()) ;

  

        return redirect()->route('wholesaler.index')
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
        
        $wholesaler= Wholesaler::findOrFail($id);
        $wholesaler-> delete();
        return redirect()-> route('wholesaler.index')
        -> with('success','Wholesaler deleted successfully');
    }

     public function count(Request $request){
         if($request->ajax()){
            

           return response()->json(['data'=> "ok",'total'=>count( Wholesaler::all() ) ]);
        
        }
        
    }
}
