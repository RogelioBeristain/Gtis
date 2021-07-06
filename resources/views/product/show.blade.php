@extends('layouts.app', [
'class' => '',
'elementActive' => 'product'
])
@section('content')
<div class="content">
    <div class="row justify-content-center">
            <div class="col-lg-10 margin-tb">
                <div class="float-left">
                    <h2> Producto {{$product->id}}</h2>
                </div>
                <div class="float-right">
                    <a class="btn btn-primary" href="{{ route('product.index') }}"> Regresar</a>
                </div>
            </div>
        </div>
        
        <div class="row justify-content-center">
            <div class="col-xs-10 col-sm-10 col-md-10">
                <div class="form-group">
                    <strong>Description:</strong>
                    {{ $product->description }}
                </div>
            </div>
            <div class="col-xs-10 col-sm-10 col-md-10">
                <div class="form-group">
                    <strong>Price:</strong>
                    {{ $product->price }}
                </div>
            </div>
        </div>
</div>
@endsection