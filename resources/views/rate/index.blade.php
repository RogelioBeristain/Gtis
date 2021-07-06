@extends('layouts.app', [
'class' => '',
'elementActive' => 'rate'
])

@section('content')
<div class="content">
<div class="row justify-content-center">
    <div class="col-lg-10 margin-tb">
        <div class="float-left">
            <h2>Lista de Cotizaciones</h2>
        </div>
        <div class="float-right">
            <a class="btn btn-success" href="{{ route('rate.createvue') }}"> Nueva Cotización</a>
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
                    <th scope="col">Número de Cotización</th>
                    <th scope="col">Importe Total</th>
                    <th scope="col">Nombre del Cliente</th>
                    <th scope="col">Vigencia</th>
                    <th scope="col" width="280px">Accion</th>
                </tr>
            </thead>
            @foreach ($rates as $rate)
            <tr>
                @if ($rate->user_id!=null)
                <td scope="row"> {{$rate->user->prefix}}{{sprintf('%05d', $rate->ratenumber) }}</td>


                @else
                <td scope="row"> {{ sprintf('%05d', $rate->ratenumber) }}</td>


                @endif
                <td data-label="Importe Total">$ {{ number_format($rate->total, 2)   }}</td>
                <td data-label="Nombre del Cliente">{{ Str::upper( $rate->client->name) }} </td>

                <td data-label="Vigencia">{{$rate->validation}}</td>


                <td data-label="Accion">

                    <div class="btn-group" role="group">


                        <!--      <a class="btn btn-info btn-sm " href="{{ route('rate.show',$rate->id) }}">Ver</a>
-->
                        <a class="btn btn-primary btn-sm" href="{{ route('rate.edit',$rate->id) }}">Modificar</a>
                        
                         <button type="button" onclick="toRemission({{$rate->id}})" class="btn btn-info btn-sm ">Generar nota de remision</button>

                        <form action="{{   route('rate.destroy',$rate->id) }}" method="POST">


                            @if ($rate->user_id==null)

                            @else

                            @if (Auth::user()->id==$rate->user->id)
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

<script>
    $(document).ready(function() {
        
       

        function toRemission(id){

        var data={client_id:id};

        console.log(data);
             $.ajax({
          url: '/remission/saveAndSend',
          type: 'GET',
          dataType: 'json',
          data: data,
          success: function() { 


          },
          error: function() { console.log('boo!'); },
          
        });
        }

       


      });

   
</script>

@endsection