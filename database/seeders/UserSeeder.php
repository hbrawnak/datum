<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\User1900To1950;
use App\Models\User1951To2000;
use App\Models\User2001To2020;
use App\Services\CsvReaderService;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file       = base_path('database/data/data.csv');
        $csv_reader = new CsvReaderService($file, ",");

        echo 'Seeding data ..';
        foreach ($csv_reader->toArray() as $data) {

            $chunks1901 = array_chunk($data['1901-1950'], 1000);
            foreach ($chunks1901 as $chunk) {
                echo '.';
                User1900To1950::insert($chunk);
                unset($chunk);
            }

            $chunks1951 = array_chunk($data['1951-2000'], 1000);
            foreach ($chunks1951 as $chunk) {
                echo '.';
                User1951To2000::insert($chunk);
                unset($chunk);
            }

            $chunks2001 = array_chunk($data['2001-2020'], 1000);
            foreach ($chunks2001 as $chunk) {
                echo '.';
                User2001To2020::insert($chunk);
                unset($chunk);
            }
        }
        echo PHP_EOL;
    }
}
