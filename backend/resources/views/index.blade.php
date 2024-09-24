@extends('layouts.main')
@section('title', 'Home')

@section('content')

<h2 class="mt-3 ms-3">Hello, world</h2>

<div class="text-center px-5 my-3 d-flex flex-column gap-3">
    <a href="/books/create" class="d-grid text-decoration-none">
        <button class="btn btn-success">Cadastrar Livro</button>
    </a>

    <a href="/books/create/autor" class="d-grid text-decoration-none">
        <button class="btn btn-success">Cadastrar Autor</button>
    </a>
</div>

<div class="col-8 m-auto">
    <table class="table text-center">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Título</th>
                <th scope="col">Preço</th>
                <th scope="col">Autor</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>

        <tbody class="table-group-divider ">
            @foreach ( $books as $book )
            @php
            $user=$book->find($book->id)->relUsers;
            @endphp
            <tr>
                <th scope="row">{{$book -> id}}</th>
                <td>{{$book -> title}}</td>
                <td>{{'R$ '.number_format($book -> price, 2, ',', '.')}}</td>
                <td>{{$user -> name}}</td>
                <td class="col-4 ">
                    <div class="d-flex gap-3">
                        <a href="/books/{{$book->id}}">
                            <button class="btn btn-info">Visualizar</button>
                        </a>

                        <a href="/books/{{$book->id}}/edit">
                            <button class="btn btn-primary">Editar</button>
                        </a>

                        <form action="/books/{{$book->id}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="btn btn-danger">Apagar</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection