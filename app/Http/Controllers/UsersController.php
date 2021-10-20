<?php

namespace App\Http\Controllers;

use App\Repository\UserRepository;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index(Request $request, UserRepository $userRepository)
    {
        //dd($request->get('year'));
        $users = $userRepository->getUsers(0, 20, $request->get('year'), $request->get('month'));
        return view('users.index', ['users' => $users]);
    }
}
