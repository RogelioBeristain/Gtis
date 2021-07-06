@extends('layouts.app', [
'class' => '',
'elementActive' => 'client'
])
@section('content')
<div class="content">
    
    @can('role-list')
        <client-mesa-component>  </client-mesa-component>
    @else
        <client-aux-mesa-component></client-aux-mesa-component>
    @endcan
 
    
    

</div>



@endsection