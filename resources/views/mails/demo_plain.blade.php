@extends('layouts.app')

@section('content')

@if ($errors->any())
<div class="alert alert-danger">
    <strong>Whoops!</strong> There were some problems with your input.<br><br>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<div class="row justify-content-center">
    <div class="col-md-6">
 
        <div class="card">
            <div class="card-header"></div>

            <div class="card-body">

          <h3>Muchas Gracias!!!, {{$mensaje['client']->name}}  el correo fue enviado con exito te responderemos a tu correo: {{$mensaje['email']}}  </h3>

            </div>
        </div>
   
    </div>
</div>




@endsection
