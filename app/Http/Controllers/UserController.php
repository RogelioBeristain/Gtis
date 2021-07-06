<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\User;
use App\Http\Resources\UserResource;
use App\Http\Resources\UserCollection;
use Illuminate\Http\Request;

class UserController extends Controller
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
        //

        if($request->ajax()){
          
            
            return new UserResource(Auth::user());
        }else{
            $users= User::all();
            return view('user.index',compact('users') );
        }

        
    }

      public function all(Request $request)
    {
        //

        if($request->ajax()){    

            return new UserCollection(User::all());
        }else{
             $user=Auth::user();
             $user=json_encode($user);
            
            return $user;
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
        $roles = Role::pluck('name','name')->all();
        return view('users.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);


        $input = $request->all();
        $input['password'] = Hash::make($input['password']);


        $user = User::create($input);
        $user->assignRole($request->input('roles'));


        return redirect()->route('users.index')
                        ->with('success','User created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         $user = User::find($id);
        return view('users.show',compact('user'));
    }

       /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function profile($id)
    {
        
        return view('user.profile');
    }
    public function photo(Request $request){

        Auth::user()->name = request('name');
        Auth::user()->email =request('email');
        Auth::user()->cargo = request('cargo');
        Auth::user()->grado =request('grado');
        Auth::user()->save();
        if ($request->hasFile('profile_pic'))
      {    
           /* $file=$request->file('profile_pic');
            
            $filename  =snake_case($file->getClientOriginalName());
            $extension = $file->getClientOriginalExtension();
         
            $picture   = date('His').'-'.$filename;
            $file->move(public_path('img'), $picture);


            $url =$picture;
            */

    $file = $request->file('profile_pic');
         // Generate a file name with extension
    $fileName = 'profile-'.time().'.'.$file->getClientOriginalExtension();

    // Save the file
    $url = $file->storeAs('public', $fileName);

        Auth::user()->url_photo = $fileName;
        Auth::user()->save();
         
            return response()->json(["message" => "Tus datos se actualizaron correctamente", "user_n"=>  new UserResource(Auth::user() ) ]);
      } 
      else
      {
            return response()->json(["message" => "Tus datos se actulizaron, no hay cambios en tu firma"]);
      }
  
    
    }
    
 /*  public function user(Request $request) {
    return $request->json_encode(user());
    }
   */

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();


        return view('users.edit',compact('user','roles','userRole'));
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
         $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);


        $input = $request->all();
        if(!empty($input['password'])){ 
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = array_except($input,array('password'));    
        }


        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();


        $user->assignRole($request->input('roles'));


        return redirect()->route('users.index')
                        ->with('success','User updated successfully');
    }
    public function solicitudes(Request $request){
        
        /**
         * data : user : name:'', warranties:{} , aplications:{}   
         */

        /*
            const headers = {
            'Content-Type': 'application/json'
            }

            axios.post(Helper.getUserAPI(), data, {
            headers: headers
            })
            .then((response) => {
            dispatch({
            type: FOUND_USER,
            data: response.data[0]
            })
            })
            .catch((error) => {
            dispatch({
            type: ERROR_FINDING_USER
            })
            }) 
        */

        /**
         *  data{ }
         */
        
        if($request->ajax()){

            $filtered = User::all()->filter(function ($user, $key) {
                if (!$user->client==null){
                     if(!($user->client->warranties->isempty())||!($user->client->aplications->isempty())){
                    
                    $user->client->aplications;
                    $user->client->warranties;
                    return $user;
                }

                }
               


            });

        return $filtered->all();

        }else{
             $user=Auth::user();
             $user=json_encode($user);
            
            return $user;
        }

       



    }

    public function count(Request $request){
         if($request->ajax()){
            
            $filtered = User::all()->filter(function ($user, $key) {
                if (!$user->client==null){
                     if(!($user->client->warranties->isempty())||!($user->client->aplications->isempty())){
                    
                    $user->client->aplications;
                    $user->client->warranties;
                    return $user;
                }

                }
               


            });

       
           return response()->json(['data'=> "ok",'total'=>count($filtered->all()) ]);
        
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        $user= User::findOrFail($id);
        $user_name=$user->name;
        $user-> delete();
        return redirect()-> route('user.index')
        -> with('success','El usuario '.$user_name.' se elimino correctamente');
    }
}
