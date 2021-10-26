<?php

namespace App\Contracts;

interface UserRepositoryInterface
{
    public function findBy(int $year, int $month);

    public function findByYear(int $year);

    public function findByMonth(int $month);
}
