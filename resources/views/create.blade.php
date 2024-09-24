@extends('layouts.main')
@section('title', 'Home')

@section('content')

<h2 class="mt-3 ms-3">Cadastrar Livro</h2>

<div class="col-8 m-auto">
    @if (isset($errors) && count($errors)>0)
        <div class="text-center my-4 p-2">
            {{$errors}} <br>
        </div>
    @endif

    <form class="d-flex flex-column gap-4" name="formCad" id="formCad" action="/books" method="POST">
        @csrf

        <input class="form-control" type="text" name="title" id="title" placeholder="Título" required>
        <select class="form-control" name="id_user" id="id_user" required>
            <option value="">Selecione o autor</option>
            @foreach ( $users as $user)
            <option value="{{$user->id}}">{{$user->name}}</option>
            @endforeach
        </select>
        <input class="form-control" type="text" name="pages" id="pages" placeholder="Páginas" required>
        <input class="form-control" type="text" name="price" id="price" placeholder="Preço" required>
        <input class="btn btn-primary" type="submit" value="Cadastrar">
    </form>
</div>
@endsection