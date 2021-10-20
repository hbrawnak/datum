<?php

namespace App\Http\Controllers;

use App\Repository\UserRepository;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index(Request $request, UserRepository $userRepository)
    {
        $users = $userRepository->getUsers();
        return view('users.index', ['users' => $users]);
    }
}
