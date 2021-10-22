<?php


namespace App\Repository;


use App\Contracts\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Facades\Cache;

class UserRepository implements UserRepositoryInterface
{
    const CACHE_TTL = 60;

    /**
     * @var User
     */
    private $user;

    /**
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }


    /**
     * @param int $offset
     * @param int $limit
     * @return mixed
     */
    public function all($limit = 500)
    {
        return Cache::remember('users:all', self::CACHE_TTL, function () use ($limit) {
            return $this->user->limit($limit)->get();
        });
    }


    /**
     * @param int $offset
     * @param int $limit
     * @param null $year
     * @param null $month
     * @return mixed
     */
    public function find($year = null, $month = null)
    {
        $key = 'users:filter:' . $year . ':' . $month;

        if (!Cache::has($key)) {
            Cache::forget(Cache::get('previous_stored_key'));

            $user = $this->user;

            if ($year) {
                $user = $user->whereYear('birthday', '=', $year);
            }

            if ($month) {
                $user = $user->whereMonth('birthday', '=', $month);
            }

            $users = $user->get();
            Cache::add($key, $users, self::CACHE_TTL);
            Cache::add('previous_stored_key', $key, self::CACHE_TTL);
        }

        return Cache::get($key);
    }
}
