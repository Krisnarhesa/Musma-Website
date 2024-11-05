<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
public function run()
    {
        DB::table("users")->insert(
            [
                "prodi_id" => null,
                "nim" => "2205551058",
                "name" => "Test User",
            ]
        );
    }
}
