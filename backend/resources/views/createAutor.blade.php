@extends('layouts.main')
@section('title', 'Home')

@section('content')

<h2 class="mt-3 ms-3">Cadastro de Autor</h2>

<div class="col-8 m-auto">
    <form class="d-flex flex-column gap-4" name="formAut" id="formAut" action="/autor" method="POST">
        @csrf

        <input class="form-control" type="text" name="name" id="name" placeholder="Nome" >
        <input class="form-control" type="email" name="email" id="email" placeholder="E-mail" >
        <input class="form-control" type="password" name="password" id="password" placeholder="Senha" >

        <input class="btn btn-primary" type="submit" value="Cadastrar">
    </form>
</div>
@endsection