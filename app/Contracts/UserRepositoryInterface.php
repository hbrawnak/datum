<?php

namespace App\Contracts;

interface UserRepositoryInterface
{
    public function all();

    public function findBy($year, $month);
}
