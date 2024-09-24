<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
use App\Models\User;
use App\Models\Book;

class BookController extends Controller
{
    private $objUser;
    private $objBook;

    public function __construct()
    {
        $this->objUser = new User();
        $this->objBook = new Book();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::all()->sortBy('id');

        return view('index', ['books' => $books]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = $this->objUser->all();
        return view('create', ['users' => $users]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BookRequest $request)
    {
        $book = $this->objBook;

        $book->title = $request->title;
        $book->pages = $request->pages;
        $book->price = $request->price;
        $book->id_user = $request->id_user;

        $book->save();

        return redirect('/books');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $book = $this->objBook->find($id);
        return view('show', ['book' => $book]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $book = $this->objBook->find($id);
        $users = $this->objUser->all();
        $selectedUserId = $book->id_user;

        return view('editar', ['users' => $users, 'book' => $book, 'selectedUserId' => $selectedUserId]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BookRequest $request, string $id)
    {
        $book = $this->objBook->where(['id' => $id])->update([
            'title' => $request->title,
            'pages' => $request->pages,
            'price' => $request->price,
            'id_user' => $request->id_user,
        ]);

    

        return redirect('/books');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $book = Book::findOrFail($id)->delete();

        return redirect('/books');
    }
}
