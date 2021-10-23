<?php


namespace App\Repository;


use App\Contracts\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class UserRepository implements UserRepositoryInterface
{
    const TTL_ONE_MINUTE = 60;

    /**
     * @var User
     */
    private $user;

    /**
     * @var DB
     */
    private $db;

    /**
     * @param User $user
     * @param DB $db
     */
    public function __construct(User $user, DB $db)
    {
        $this->user = $user;
        $this->db = $db;
    }


    /**
     * @param int $offset
     * @param int $limit
     * @return mixed
     */
    public function all($limit = 500)
    {
        return Cache::remember('users:all', self::TTL_ONE_MINUTE, function () use ($limit) {
            return $this->db::table('users')->limit($limit)->get();
        });
    }


    /**
     * @param int $offset
     * @param int $limit
     * @param null $year
     * @param null $month
     * @return mixed
     */
    public function findBy($year = null, $month = null)
    {
        $key = 'users:filter:' . $year . ':' . $month;

        if (!Cache::has($key)) {
            Cache::forget(Cache::get('previous_stored_key'));

            $user = $this->db::table('users');

            if ($year) {
                $user = $user->where('year', '=', $year);
            }

            if ($month) {
                $user = $user->where('month', '=', $month);
            }

            $users = $user->get();
            Cache::add($key, $users, self::TTL_ONE_MINUTE);
            Cache::add('previous_stored_key', $key, self::TTL_ONE_MINUTE);
        }

        return Cache::get($key);
    }
}
