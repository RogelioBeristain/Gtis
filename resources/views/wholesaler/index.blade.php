@extends('layouts.app', [
'class' => '',
'elementActive' => 'wholesaler'
])
@section('content')
<div class="content">
    <div class="container">
    
        @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
        @endif
    
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="d-flex align-items-center p-2 my-2 text-white-50 bg-dark rounded shadow-sm">
    
                    <div class="lh-100">
                        <h6 class="mb-0 text-white lh-100">Moyoristas</h6>
                        <a class="" href="{{ route('wholesaler.create') }}">Agregar un Mayorista </a>
                    </div>
                </div>
                @foreach ($wholesalers as $wholesaler)
                <div class="card p-2 my-2 ">
                    <div class="card-header">
                        {{ strtoupper($wholesaler->name) }}
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">{{$wholesaler->code}}</li>
                    </ul>
                    <div class="card-body">
    
    
                        <a class="btn btn-primary" href="{{ route('wholesaler.edit',$wholesaler->id) }}">Editar</a>
    
    
                    </div>
                </div>
                @endforeach
    
            </div>
        </div>
    
    </div>
</div>




@endsection