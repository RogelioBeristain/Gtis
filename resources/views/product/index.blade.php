@extends('layouts.app', [
'class' => '',
'elementActive' => 'product'
])
@section('content')
   <div class="content">
       <div class="row justify-content-center">
            <div class="col-lg-10 margin-tb">
                <div class="float-left">
                    <h2>Lista de Productos</h2>
                </div>
                <div class="float-right">
                    <a class="btn btn-success" href="{{ route('product.create') }}"> Nuevo Producto</a>
                </div>
            </div>
        </div>
        
        @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
        @endif
        
        
        <div class="row  justify-content-center">
        
        
        
            <div class="col-lg-10 margin-tb">
        
                <table class="table table-responsive table-sm table-hover table-bordered table-striped">
        
                    <thead>
                        <tr>
                            <th scope="col">Código de Producto</th>
                            <th scope="col">Descripción</th>
                            <th scope="col">Modelo</th>
                            <th scope="col">Precio</th>
                            <th scope="col" width="280px">Accion</th>
                        </tr>
        
                    </thead>
                    @foreach ($products as $product)
                    <div class="modal fade" id="modalDescription{{$product->id}}" tabindex="-1" role="dialog">
                        <div class="modal-dialog   modal-dialog-scrollable modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Descripción del producto</h5>
                                    <button type="button" class="close" data-dismiss="modal">
        
                                    </button>
                                </div>
                                <div id="modalBody" class="modal-body">
                                    {!!$product->description!!}
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        
                                </div>
                            </div>
                        </div>
                    </div>
                    <tr>
                        <td scope="row">{{ $product->code }}</td>
                        <td data-label="Descripción"> <button type="button" class="btn btn-primary btn-sm " data-toggle="modal"
                                data-target="#modalDescription{{$product->id}}">
                                ver descripción
                            </button> </td>
                        <td data-label="Modelo">{{ $product->model }}</td>
                        <td data-label="Accion">$ {{  number_format( $product->price, 2)   }}</td>
        
        
                        <td data-label="Precio">
                            <form action="{{ route('product.destroy',$product->id) }}" method="POST">
        
                                <div class="btn-group btn-group-sm" role="group">
                                    <a class="btn btn-info btn-sm" href="{{ route('product.show',$product->id) }}">Ver</a>
        
                                    <a class="btn btn-primary btn-sm" href="{{ route('product.edit',$product->id) }}">Editar</a>
        
                                    @csrf
                                    @method('DELETE')
        
                                    <button type="submit" class="btn btn-danger btn-sm">Borrar</button>
                                </div>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        
        
        
        
        </div>
   </div>


      
@endsection