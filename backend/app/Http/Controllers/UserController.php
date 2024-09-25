<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Interfaces\UserRepositoryInterface;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function indexApi()
    {
        $users = $this->userRepository->all();

        return response()->json($users);
    }


    public function createAutor()
    {
        return view('createAutor');
    }

    public function storeAutor(UserRequest $request)
    {
        $data = $request->only('name','email','password');
        $this->userRepository->create(data: $data);

        return redirect('/books');
    }

    public function storeAutorApi(UserRequest $request){
        $data = $request->only('name','email','password');
        $this->userRepository->create(data: $data);

        return response()->json(data: $data);
    }
}