@extends('layouts.app', [
'class' => '',
'elementActive' => 'roles'
])

@section('content')
<div class="content">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="float-left">
                <h2>Administrador de Roles de Usuario</h2>
            </div>
            <div class="float-right">
                @can('role-create')
                <a class="btn btn-success" href="{{ route('roles.create') }}"> Nuevo Rol</a>
                @endcan
            </div>
        </div>
    </div>
    
    
    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif
    
    
    <table class="table table-bordered table-striped  ">
        <tr>
            <th>No</th>
            <th>Nombre</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($roles as $key => $role)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $role->name }}</td>
            <td>
    
            </td>
        </tr>
        @endforeach
    </table>
    
    
    {!! $roles->render() !!}
</div>
@endsection