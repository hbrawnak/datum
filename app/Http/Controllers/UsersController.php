<?php

namespace App\Http\Controllers;

use App\Repository\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class UsersController extends Controller
{
    public function index(Request $request, UserRepository $userRepository, Cache $cache)
    {
        $year = $request->get('year');
        $month = $request->get('month');
        // If year or month cache in redis with ($year . $month . limit . offset) key
        // else cache all data in redis

        $users = $userRepository->getUsers(0, 20, $year, $month);
        return view('users.index', ['users' => $users]);
    }
}
