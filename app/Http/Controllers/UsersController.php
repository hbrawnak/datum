<?php

namespace App\Http\Controllers;

use App\Repository\UserRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class UsersController extends Controller
{
    const rowPerPage = 20;

    /**
     * @param Request $request
     * @param UserRepository $userRepository
     * @return Application|Factory|View
     */
    public function index(Request $request, UserRepository $userRepository)
    {
        $year  = $request->get('year');
        $month = $request->get('month');
        $page  = $request->get('page', 1);

        if ($year && $month) {
            $users = $userRepository->findBy($year, $month);
        } elseif ($year && !$month) {
            $users = $userRepository->findByYear($year);
        } elseif (!$year && $month) {
            $users = $userRepository->findByMonth($month);
        } else {
            $users = $userRepository->all();
        }

        $data = new LengthAwarePaginator(
            $users->forPage($page, self::rowPerPage),
            $users->count(),
            self::rowPerPage,
            $page);

        return view('users.index', ['users' => $data, 'year' => $year, 'month' => $month]);
    }
}
