<?php


namespace App\Repository;


use App\Contracts\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Facades\Cache;

class UserRepository implements UserRepositoryInterface
{
    /**
     * @var User
     */
    private $user;

    /**
     * @var Cache
     */
    private $cache;

    public function __construct(User $user, Cache $cache)
    {
        $this->user  = $user;
        $this->cache = $cache;
    }


    public function getUsers($offset = 0, $limit = 20, $year = null, $month = null)
    {
        return Cache::remember('users-' . $offset, 10, function () use ($offset, $limit, $year, $month) {
            $user = $this->user;

            if ($year) {
                $user = $user->whereYear('birthday', '=', $year);
            }

            if ($month) {
                $user = $user->whereMonth('birthday', '=', $month);
            }

            return $user->offset($offset)->limit($limit)->get();
        });
    }
}
