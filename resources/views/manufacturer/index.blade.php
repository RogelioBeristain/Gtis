@extends('layouts.app', [
'class' => '',
'elementActive' => 'manufacturer'
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
                    <h6 class="mb-0 text-white lh-100">Fabricantes</h6>
                    <a class="" href="{{ route('manufacturer.create') }}">Agregar un Fabricante </a>
                </div>
            </div>
            @foreach ($manufacturers as $manufacturer)
            <div class="card p-2 my-2 ">
                <div class="card-header">
                    {{strtoupper( $manufacturer->name) }}
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">{{$manufacturer->number}}</li>
                    <li class="list-group-item">{{  strtolower($manufacturer->email)}}</li>
                </ul>
                <div class="card-body">


                    <a class="btn btn-primary" href="{{ route('manufacturer.edit',$manufacturer->id) }}">Editar</a>


                </div>
            </div>
            @endforeach

        </div>
    </div>

</div>
</div>



@endsection