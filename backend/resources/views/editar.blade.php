@extends('layouts.main')
@section('title', 'Home')

@section('content')

<h2 class="mt-3 ms-3">Editar Livro</h2>

<div class="col-8 m-auto">
    @if (isset($errors) && count($errors)>0)
    <div class="text-center my-4 p-2 alert alert-danger" role="alert">
        @foreach ($errors->all() as $error)
        {{$error}} <br>
        @endforeach
    </div>
    @endif

    <form class="d-flex flex-column gap-4" name="formCad" id="formCad" action="/books/{{$book->id}}/update" method="POST">
        @csrf
        @method('PUT')

        <input class="form-control" type="text" name="title" id="title" placeholder="Título" value="{{$book->title}}" required>
        <select class="form-control" name="id_user" id="id_user" required>
            @foreach ( $users as $user)
            <option value="{{ $user->id }}"
                {{ $user->id == old('id_user', $selectedUserId) ? 'selected' : '' }}
            >
                {{ $user->name }}
            </option>

            @endforeach
        </select>
        <input class="form-control" type="text" name="pages" id="pages" placeholder="Páginas" value={{$book->pages}} required>
        <input class="form-control" type="text" name="price" id="price" placeholder="Preço" value={{$book->price}} required>
        <input class="btn btn-primary" type="submit" value="Editar">
    </form>
</div>
@endsection