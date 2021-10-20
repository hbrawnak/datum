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


    public function getUsers($offset = 0, $limit = 20)
    {
        return Cache::remember('users-' . $offset, 10, function () use ($offset, $limit) {
            return $this->user->offset($offset)->limit($limit)->get();
        });
    }
}
