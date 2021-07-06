@extends('layouts.app', [
'class' => '',
'elementActive' => 'manufacturer'
])
@section('content')
<div class="content">
    <div class="container">
    
    
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
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Agregar un Fabricante Nuevo
                    </div>
                    <div class="card-body">
    
                        <form action="{{ route('manufacturer.update',$manufacturer->id) }}" method="POST">
                            @csrf
                            @method('PUT')
    
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">
                                    Nombre
                                </label>
                                <div class="col-md-6">
                                    <input type="text" value="{{$manufacturer->name}}" name="name" class="form-control"
                                        autofocus required autocomplete="new-password" placeholder="Nombre del Fabricante">
                                </div>
    
                            </div>
                            <div class="form-group row">
                                <label for="number" class="col-md-4 col-form-label text-md-right">
                                    Numero de contacto:
                                </label>
                                <div class="col-md-6">
    
                                    <input class="form-control" type="tel" value="{{$manufacturer->number}}" id="number"
                                        name="number" autocomplete="new-password" placeholder="Numero de contacto">
    
    
    
                                </div>
    
                            </div>
    
                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">
                                    Correo de Contacto
                                </label>
                                <div class="col-md-6">
                                    <input type="email" value="{{$manufacturer->email}}" name="email" class="form-control"
                                        autofocus required autocomplete="new-password" placeholder="Correo de Contacto">
                                </div>
    
                            </div>
    
    
    
                            <div class="form-goup row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">Guardar</button>
    
                                </div>
    
                            </div>
    
    
    
                        </form>
                    </div>
                </div>
            </div>
    
        </div>
    
    
    
    
    
    
    
    </div>
</div>


@endsection