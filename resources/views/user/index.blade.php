@extends('layouts.app', [
'class' => '',
'elementActive' => 'user'
])
@section('content')

{{-- <main role="main" class="container">
    <div class="d-flex align-items-center p-3 my-3 text-white-50 bg-dark rounded box-shadow">
     
      <span style="color: Mediumslateblue; font-size: 30px; padding: 10px;" ><i class="fas fa-users"></i></span>
      <div class="lh-50">
        <h4 class="mb-0 text-white lh-50">Usuarios</h4>
        <small></small>
      </div>
    </div>

    <div class="my-3 p-3 bg-white rounded box-shadow">
      <h6 class="border-bottom border-gray pb-2 mb-0">Lista de usuarios</h6>

      @foreach ($users as $user)
      <div class="media text-muted pt-3">
        <span  class="mr-2 rounded" style="font-size: 32px;"  data-holder-rendered="true">
          <i class="far fa-user"></i>
        </span>
        <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
      <strong class="d-block text-gray-dark">  {{ strtolower($user->email )}}</strong>
          
           
             Nombre: " {{ strtoupper($user->name) }}"
             <br>
           Rol: 
             @forelse ($user->roles as $item)
                 {{$item->name}}
             @empty
                 null
             @endforelse
        
             <br>
             Numero de cotizaciones: {{$user->rates->count()}}

             <img width="40px" height="40px" src={{$user->url_path}} alt="sin firma">
           
            <!--
            <button type="submit" class="btn btn-primary mb-2">Confirm identity</button>
            -->
         
         
        </p>
        @if (Auth::user()->id!=$user->id)
        <form action="{{   route('user.destroy',$user->id) }}"  method="POST" >
        
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-danger btn-sm ">Eliminar</button>
        </form>  
        @endif
      

      </div>
      @endforeach
  
      
      <!--

       
        <small class="d-block text-right mt-3">
        <a href="#">All updates</a>
        </small>
    -->
    </div>

  </main>
   --}}
  
   <div  class="content">
    <users-component></users-component>
   </div>

  @endsection