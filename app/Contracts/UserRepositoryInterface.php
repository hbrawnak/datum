<?php

namespace App\Contracts;

interface UserRepositoryInterface
{
    public function all();

    public function findBy($year, $month);

    public function findByYear($year);

    public function findByMonth($month);
}
