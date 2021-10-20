<?php


namespace App\Repository;


use App\Contracts\UserRepositoryInterface;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    /**
     * @var User
     */
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }


    public function getUsers($offset = 0, $limit = 20)
    {
        return $this->user->offset($offset)->limit($limit)->get();
    }
}
