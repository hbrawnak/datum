<?php


namespace App\Repository;


use App\Contracts\UserRepositoryInterface;
use App\DBHelper;
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
        $this->db   = $db;
    }


    /**
     * @param int $limit
     * @return mixed
     */
    public function all(int $limit = 100)
    {
        return Cache::remember('users:all', self::TTL_ONE_MINUTE, function () use ($limit) {
            return $this->user
                ->select('id', 'name', 'email', 'birthday', 'phone', 'ip', 'country')
                ->limit($limit)->get();
        });
    }


    /**
     * @param int $year
     * @param int $month
     * @return mixed
     */
    public function findBy(int $year, int $month)
    {
        $key = 'users:filter:' . $year . ':' . $month;

        if (!Cache::has($key)) {
            Cache::forget(Cache::get('previous_stored_key'));

            $table = $this->db::table(DBHelper::getTable($year));
            $users = $table->select('id', 'name', 'email', 'birthday', 'phone', 'ip', 'country')
                ->where('year', '=', $year)
                ->where('month', '=', $month)
                ->get();

            Cache::add($key, $users, self::TTL_ONE_MINUTE);
            Cache::add('previous_stored_key', $key, self::TTL_ONE_MINUTE);
        }

        return Cache::get($key);
    }


    /**
     * @param int $year
     * @return mixed
     */
    public function findByYear(int $year)
    {
        $key = 'users:filter:' . $year;

        if (!Cache::has($key)) {
            Cache::forget(Cache::get('previous_stored_key'));

            $table = $this->db::table(DBHelper::getTable($year));
            $users = $table->select('id', 'name', 'email', 'birthday', 'phone', 'ip', 'country')
                ->where('year', '=', $year)
                ->orderBy('month')
                ->get();

            Cache::add($key, $users, self::TTL_ONE_MINUTE);
            Cache::add('previous_stored_key', $key, self::TTL_ONE_MINUTE);
        }

        return Cache::get($key);
    }


    /**
     * @param int $month
     * @return mixed
     */
    public function findByMonth(int $month)
    {
        $key = 'users:filter:' . $month;

        if (!Cache::has($key)) {
            Cache::forget(Cache::get('previous_stored_key'));

            $usersTill1950 = $this->db::table(DBHelper::USER_1900_TO_1950)
                ->select('id', 'name', 'email', 'birthday', 'phone', 'ip', 'country')
                ->where('month', '=', $month)
                ->orderBy('year');

            $usersTill2000 = $this->db::table(DBHelper::USER_1951_TO_2000)
                ->select('id', 'name', 'email', 'birthday', 'phone', 'ip', 'country')
                ->where('month', '=', $month)
                ->orderBy('year');

            $usersTill2020 = $this->db::table(DBHelper::USER_2001_TO_2020)
                ->select('id', 'name', 'email', 'birthday', 'phone', 'ip', 'country')
                ->where('month', '=', $month)
                ->orderBy('year');

            $users = $usersTill1950
                ->unionAll($usersTill2000)
                ->unionAll($usersTill2020)
                ->get();

            Cache::add($key, $users, self::TTL_ONE_MINUTE);
            Cache::add('previous_stored_key', $key, self::TTL_ONE_MINUTE);
        }

        return Cache::get($key);
    }
}
