<?php

namespace Tests\Unit;

use App\DBHelper;
use PHPUnit\Framework\TestCase;

class DatabaseHelperTest extends TestCase
{
    /**
     * @return void
     */
    public function test_user1900_to150s()
    {
        $helper = new DBHelper();
        $this->assertEquals('user1900_to1950s', $helper::getTable(1934));
    }


    /**
     * @return void
     */
    public function test_user1951_to2000s()
    {
        $helper = new DBHelper();
        $this->assertEquals('user1951_to2000s', $helper::getTable(2000));
    }


    /**
     * @return void
     */
    public function test_user2001_to2020s()
    {
        $helper = new DBHelper();
        $this->assertEquals('user2001_to2020s', $helper::getTable(2008));
    }
}
