@extends('layouts.app', [
'class' => '',
'elementActive' => 'remision'
])

@section('content')
<div class="content">
<div class="row justify-content-center">
    <div class="col-lg-10 margin-tb">
        <div class="float-left">
            <h2>Lista de Notas de Remision</h2>
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
                    <th scope="col">Número de Folio</th>
                    <th scope="col">Importe Total</th>
                    <th scope="col">Nombre del Cliente</th>
                    <th scope="col">Fecha</th>
                    <th scope="col" width="280px">Accion</th>
                </tr>
            </thead>
            @foreach ($remissions as $remission)
            <tr>
                @if ($remission->user_id!=null)
                <td scope="row"> {{$remission->user->prefix}}{{sprintf('%05d', $remission->remission_number) }}</td>


                @else
                <td scope="row"> {{ sprintf('%05d', $remission->remission_number) }}</td>


                @endif
                <td data-label="Importe Total">$ {{ number_format($remission->total, 2)   }}</td>
                <td data-label="Nombre del Cliente">{{ Str::upper( $remission->client->name) }} </td>

                <td data-label="Vigencia">{{$remission->created_at}}</td>


                <td data-label="Accion">

                    <div class="btn-group" role="group">


                        <!--      <a class="btn btn-info btn-sm " href="{{ route('rate.show',$rate->id) }}">Ver</a>
-->
                       {{--  <a class="btn btn-primary btn-sm" href="{{ route('rate.edit',$rate->id) }}">Modificar</a>
 --}}

                        <form action="{{   route('remission.destroy',$remission->id) }}" method="POST">


                            @if ($remission->user_id==null)

                            @else

                            @if (Auth::user()->id==$remission->user->id)
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm ">Eliminar</button>


                            @endif

                            @endif


                        </form>

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