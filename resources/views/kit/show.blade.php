@extends('layouts.app', [
'class' => '',
'elementActive' => 'kit'
])
@section('content')
<div class="content">
    <div class="row justify-content-center">
            <div class="col-lg-10 margin-tb">
                <div class="float-left">
                    <h2> Kit {{$kit->id}}</h2>
                </div>
                <div class="float-right">
                    <a class="btn btn-primary" href="{{ route('kit.index') }}"> Regresar</a>
                </div>
            </div>
        </div>
        
        <div class="row justify-content-center">
            <div class="col-xs-10 col-sm-10 col-md-10">
                <div class="form-group">
                    <strong>Título: </strong>
        
                    <input type="text" class="form-control" readonly value="{{ $kit->title }}">
                </div>
            </div>
            <div class="col-xs-10 col-sm-10 col-md-10">
                <div class="form-group">
                    <strong>Descripción General del Kit:</strong>
        
        
                    <textarea type="text" class="form-control" readonly>
                            {{ $kit->description }}
                        </textarea>
                </div>
            </div>
        
        
            <div class="col-xs-10 col-sm-10 col-md-10">
        
                <table class="table table-bordered table-striped ">
                    <tr>
                        <th>Código de Producto</th>
                        <th>Descripción</th>
                        <th>Modelo</th>
                        <th>Precio</th>
                    </tr>
                    @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->code }}</td>
                        <td>{{ $product->description }}</td>
                        <td>{{ $product->model }}</td>
                        <td>{{ $product->price }}</td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
</div>
@endsection