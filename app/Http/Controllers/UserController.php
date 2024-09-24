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

    public function createAutor()
    {
        return view('createAutor');
    }

    public function storeAutor(UserRequest $request)
    {
        $data = $request->only('name','email','password');
        $user = $this->userRepository->create(data: $data);

        return redirect('/books');
    }
}
