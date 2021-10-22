<?php

namespace Database\Seeders;

use App\Models\User;
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
        $file = fopen(base_path("database/data/data.csv"), "r");

        $line = true;
        $data_array = [];

        while (($data = fgetcsv($file, 10000, ",")) !== FALSE) {
            if (!$line) {
                    $data_array[] = [
                        "id"        => $data['0'],
                        "email"     => $data['1'],
                        "name"      => $data['2'],
                        "birthday"  => $data['3'],
                        "phone"     => $data['4'],
                        "ip"        => $data['5'],
                        "country"   => $data['6'],
                    ];
            }
            $line = false;
        }

        $chunks = array_chunk($data_array, 1000);
        foreach ($chunks as $chunk) {
            echo '.';
            User::insert($chunk);
        }
        echo PHP_EOL;
    }
}
