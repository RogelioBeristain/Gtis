@extends('layouts.app', [
'class' => '',
'elementActive' => 'client'
])
@section('content')
    <div class="content">
<div class="row justify-content-center">
    <div class="col-lg-10 margin-tb">
        <div class="float-left">
            <h2>Lista de Clientes</h2>
        </div>
        <div class="float-right">
            <a class="btn btn-success" href="{{ route('client.create') }}"> Nuevo Cliente</a>
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
            <tr>
                <th>Nombre</th>
                <th>RFC</th>
                <th>Email</th>
                <th>Número de Contacto</th>
                <th width="280px">Action</th>
            </tr>
            @foreach ($clients as $client)



            <div class="modal fade   " id="exampleModalCenter{{$client->id}}" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog  modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle">{{$client->name}}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="input-group input-group-sm mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text " style="width:130px" id="inputGroup-sizing-sm">Nombre
                                        del Cliente</span>
                                </div>
                                <input type="text" readonly class="form-control" aria-label="Sizing example input"
                                    aria-describedby="inputGroup-sizing-sm" value="{{$client->name}}">
                            </div>

                            <div class="input-group input-group-sm mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="width:130px"
                                        id="inputGroup-sizing-sm">Dirección</span>
                                </div>
                                <input type="text" readonly class="form-control" aria-label="Sizing example input"
                                    aria-describedby="inputGroup-sizing-sm" value="{{$client->address}}">
                            </div>

                            <div class="input-group input-group-sm mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="width:130px"
                                        id="inputGroup-sizing-sm">Pais</span>
                                </div>
                                <input type="text" readonly class="form-control" aria-label="Sizing example input"
                                    aria-describedby="inputGroup-sizing-sm" value="{{$client->country}}">
                            </div>
                            <div class="input-group input-group-sm mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="width:130px"
                                        id="inputGroup-sizing-sm">Estado</span>
                                </div>
                                <input type="text" readonly class="form-control" aria-label="Sizing example input"
                                    aria-describedby="inputGroup-sizing-sm" value="{{$client->state}}">
                            </div>

                            <div class="input-group input-group-sm mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="width:130px"
                                        id="inputGroup-sizing-sm">Ciudad</span>
                                </div>
                                <input type="text" readonly class="form-control" aria-label="Sizing example input"
                                    aria-describedby="inputGroup-sizing-sm" value="{{$client->city}}">
                            </div>

                            <div class="input-group input-group-sm mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="width:130px"
                                        id="inputGroup-sizing-sm">RFC</span>
                                </div>
                                <input type="text" readonly class="form-control" aria-label="Sizing example input"
                                    aria-describedby="inputGroup-sizing-sm" value="{{$client->rfc}}">
                            </div>


                            <div class="input-group input-group-sm mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="width:130px" id="inputGroup-sizing-sm">Numero
                                        de contacto</span>
                                </div>
                                <input type="tel" readonly class="form-control" aria-label="Sizing example input"
                                    aria-describedby="inputGroup-sizing-sm" value="{{$client->number}}">
                            </div>

                            <div class="input-group input-group-sm mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="width:130px" id="inputGroup-sizing-sm">Correo
                                        Electrónico</span>
                                </div>
                                <input type="email" readonly class="form-control" aria-label="Sizing example input"
                                    aria-describedby="inputGroup-sizing-sm" value="{{$client->email}}">
                            </div>

                            <ul class="list-group">

                                @foreach ($client->clientcontacts as $contact)
                                <a data-toggle="collapse" href="#c{{$contact->id}}" role="button"
                                    aria-controls="c{{$contact->id}}" aria-expanded="false"
                                    class="list-group-item list-group-item-action">
                                    <li class=" d-flex justify-content-between align-items-center">
                                        {{$contact->name}}
                                        <span
                                            class="badge badge-primary badge-pill">{{$contact->clientemails->count()+$contact->clientphonenumbers->count() }}</span>

                                    </li>
                                </a>

                                <div class="collapse" id="c{{$contact->id}}">
                                    @foreach ($contact->clientphonenumbers as $number)
                                    <div class="card card-body">
                                        {{$number->number}}
                                    </div>
                                    @endforeach

                                    @foreach ($contact->clientemails as $email)
                                    <div class="card card-body">
                                        {{$email->email}}
                                    </div>
                                    @endforeach
                                </div>
                                @endforeach


                            </ul>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

                            <a class="btn btn-primary" href="{{ route('client.edit',$client->id) }}">Editar</a>

                        </div>
                    </div>
                </div>
            </div>


            <tr>
                <td>{{ strtoupper($client->name) }}</td>
                <td>{{ strtoupper($client->rfc) }}</td>
                <td>{{ strtolower($client->email) }}</td>
                <td>{{ $client->number }}</td>.




                <td>



                    <!-- <a class="btn btn-info" href="{{ route('client.show',$client->id) }}">Ver</a> -->

                    <button type="button" class="btn btn-primary" data-toggle="modal"
                        data-target="#exampleModalCenter{{$client->id}}">
                        Ver
                    </button>



                    <a class="btn btn-primary" href="{{ route('client.edit',$client->id) }}">Editar</a>


                </td>
            </tr>
            @endforeach
        </table>
    </div>




</div>
    </div>




      
@endsection