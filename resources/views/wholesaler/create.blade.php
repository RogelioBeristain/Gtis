@extends('layouts.app', [
'class' => '',
'elementActive' => 'wholesaler'
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
                        Agregar un Mayorista Nuevo
                    </div>
                    <div class="card-body">
    
                        <form action="{{ route('wholesaler.store') }}" method="POST">
                            @csrf
    
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">
                                    Nombre
                                </label>
                                <div class="col-md-6">
                                    <input type="text" name="name" required class="form-control" autofocus required
                                        autocomplete="new-password" placeholder="Nombre del Mayorista">
                                </div>
    
                            </div>
                            <div class="form-group row">
                                <label for="number" class="col-md-4 col-form-label text-md-right">
                                    Código:
                                </label>
                                <div class="col-md-6">
    
                                    <input class="form-control" required type="text" id="code" name="code"
                                        autocomplete="new-password" placeholder="Codigo de mayorista">
    
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