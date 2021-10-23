<?php


namespace App;


class DBHelper
{
    const USER_1900_TO_1950 = 'user1900_to1950s';
    const USER_1951_TO_2000 = 'user1951_to2000s';
    const USER_2001_TO_2020 = 'user2001_to2020s';


    public static function getTable($year)
    {
        if ($year < 1951) {
            return self::USER_1900_TO_1950;
        }

        if ($year < 2001 && $year >= 1951) {
            return self::USER_1951_TO_2000;
        }

        if ($year >= 2001) {
            return self::USER_2001_TO_2020;
        }
    }

}