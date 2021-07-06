@extends('layouts.app', [
'class' => '',
'elementActive' => 'kit'
])
@section('content')
    <div class="content">

        <div class="row justify-content-center">
            <div class="col-lg-10 margin-tb">
                <div class="float-left">
                    <h2>Lista de Kits</h2>
                </div>
                <div class="float-right">
                    <a class="btn btn-success" href="{{ route('kit.create') }}"> Nuevo Kit</a>
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
        
                <table class="table table-bordered table-striped ">
                    <tr>
                        <th>Título</th>
                        <th>Precio</th>
        
                        <th width="280px">Action</th>
                    </tr>
                    @foreach ($kits as $kit)
                    <tr>
                        <td>{{ $kit->title }}</td>
                        <td>$ {{   number_format($kit->getPrice(),2) }}</td>
        
                        <td>
                            <form action="{{ route('kit.destroy',$kit->id) }}" method="POST">
        
                                <a class="btn btn-info" href="{{ route('kit.show',$kit->id) }}">Ver</a>
        
                                <a class="btn btn-primary" href="{{ route('kit.edit',$kit->id) }}">Editar</a>
        
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Borrar</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        
        
        
        
        </div>
    </div>
    



      
@endsection