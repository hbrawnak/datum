<?php

namespace App\Contracts;

interface UserRepositoryInterface
{
    public function getUsers($offset, $limit, $year = null, $month = null);
}