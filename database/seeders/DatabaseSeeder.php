<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class);
        $this->command->info('Role are seeded!');
        $this->call(ProdiSeeder::class);
        $this->command->info('Program Studi are seeded!');

        if (env('APP_ENV') == 'local') {
            $this->call(UserSeeder::class);
            $this->command->info('User are seeded!');
        }
    }
}
