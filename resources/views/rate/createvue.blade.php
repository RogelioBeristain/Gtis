@extends('layouts.app', [
'class' => '',
'elementActive' => 'rate'
])
@section('content')


<div class="content">
    <div class="container">


        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="row justify-content-center">
            <div class="col-md-12">
               
                        <rate-component></rate-component>

           
            @endsection