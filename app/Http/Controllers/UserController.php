<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{

    private $objUser;

    public function __construct()
    {
        $this->objUser = new User();
    }

    public function createAutor()
    {
        return view('createAutor');
    }

    public function storeAutor(UserRequest $request)
    {
        $user = $this->objUser;

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;

        $user->save();

        return redirect('/books');
    }
}
