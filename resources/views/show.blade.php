@extends('layouts.main')
@section('title', 'Home')

@section('content')

<h2 class="mt-3 ms-3">Visualizando {{$book->title}}</h2>
@php
$user=$book->find($book->id)->relUsers;
@endphp

<div class="col-8 m-auto">
    <div class="card text-center">
        <div class="card-body">
            <h3>{{$book->title}}</h3>
            <h5>Por <strong>{{$user->name}}</strong></h5>
            <h6>E-mail do autor: {{$user->email}}</h6>
            <h6>{{'R$ '.number_format($book -> price, 2, ',', '.')}}</h6>
        </div>
    </div>
</div>
@endsection