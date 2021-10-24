<?php

namespace Database\Seeders;

use App\DBHelper;
use App\Models\User1900To1950;
use App\Models\User1951To2000;
use App\Models\User2001To2020;
use App\Services\CSVReaderService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
        $csv_reader = new CSVReaderService($file, ",");

        echo 'Seeding data ..';
        foreach ($csv_reader->toArray() as $data) {

            $chunks1901 = array_chunk($data['1901-1950'], 500);
            foreach ($chunks1901 as $chunk) {
                echo '.';
                DB::table(DBHelper::USER_1900_TO_1950)->insert($chunk);
                unset($chunk);
            }

            $chunks1951 = array_chunk($data['1951-2000'], 500);
            foreach ($chunks1951 as $chunk) {
                echo '.';
                DB::table(DBHelper::USER_1951_TO_2000)->insert($chunk);
                unset($chunk);
            }

            $chunks2001 = array_chunk($data['2001-2020'], 500);
            foreach ($chunks2001 as $chunk) {
                echo '.';
                DB::table(DBHelper::USER_2001_TO_2020)->insert($chunk);
                unset($chunk);
            }
        }
        echo PHP_EOL;
    }
}
