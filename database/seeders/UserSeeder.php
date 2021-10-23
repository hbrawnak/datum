<?php

namespace Database\Seeders;

use App\Models\User;
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
            $chunks = array_chunk($data, 1000);
            foreach ($chunks as $chunk) {
                echo '.';
                User::insert($chunk);
                unset($chunk);
            }
        }
        echo PHP_EOL;
    }
}
