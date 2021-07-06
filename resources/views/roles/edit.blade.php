@extends('layouts.app_old', [
'class' => '',
'elementActive' => 'roles'
])

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="float-left">
            <h2>Editar Role</h2>
        </div>
     
    </div>
</div>


@if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
@endif


   <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nombre:</strong>
                  <input type="text" required name="name"  placeholder="Nombre" class="form-control" autocomplete="new-password">
     </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Permisos:</strong>
                <br/>
                @foreach($permission as $value)
                    <label>
                        <input type="checkbox" value=false>
                   {{ $value->name }}</label>
                <br/>
                @endforeach
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
    </div>



@endsection
