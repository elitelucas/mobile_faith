<?php

use Illuminate\Database\Seeder;
use App\Meditate;
use App\Background;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        DB::table('users')->insert([
            'email' => 'faithspaceapp@gmail.com',
            'password' => Hash::make('faith'),
            'is_admin' => 1,
        ]);     
    }
}
