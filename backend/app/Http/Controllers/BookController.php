<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
use App\Interfaces\BookRepositoryInterface;
use App\Models\User;

class BookController extends Controller
{
    private $objUser;
    private $bookRepository;

    public function __construct(BookRepositoryInterface $bookRepository)
    {
        $this->objUser = new User();
        $this->bookRepository = $bookRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = $this->bookRepository->all();

        return view('index', ['books' => $books]);
    }

    public function indexApi()
    {
        $books = $this->bookRepository->all()->load('relUsers');

        return response()->json($books);
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
        $data = $request->only(['title', 'pages', 'price', 'id_user']);
        $this->bookRepository->create($data);

        return redirect('/books');
    }

    public function storeApi(BookRequest $request)
    {
        $data = $request->only(['title', 'pages', 'price', 'id_user']);
        $this->bookRepository->create($data);

        return response()->json(data: $data);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $book = $this->bookRepository->find($id);
        return view('show', ['book' => $book]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $book = $this->bookRepository->find($id);
        $users = $this->objUser->all();
        $selectedUserId = $book->id_user;

        return view('editar', ['users' => $users, 'book' => $book, 'selectedUserId' => $selectedUserId]);
    }

    public function editApi(string $id)
    {
        $book = $this->bookRepository->find($id)->load('relUsers');
        $users = $this->objUser->all();
        $selectedUserId = $book->id_user;

        return response()->json($book);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BookRequest $request, string $id)
    {
        $data = $request->only(['title', 'pages', 'price', 'id_user']);
        $this->bookRepository->update($data, $id);

        return redirect('/books');
    }

    public function updateApi(BookRequest $request, string $id)
    {
        $data = $request->only(['title', 'pages', 'price', 'id_user']);
        $this->bookRepository->update($data, $id);

        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->bookRepository->delete($id);

        return redirect('/books');
    }

    public function destroyApi(string $id)
    {

        return  $this->bookRepository->delete($id);;
    }
}