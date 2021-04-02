<?php

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
        // $this->call(UsersTableSeeder::class);
        DB::table('users')->insert([
            'email' => 'admin@admin.com',
            'password' => Hash::make('123456'),          
            'is_admin' => 1,          
        ]);

        DB::table('backgrounds')->insert([
            'path' => 'uploads/background/1.jpg',              
        ]);
        DB::table('backgrounds')->insert([
            'path' => 'uploads/background/2.jpg',              
        ]);
        DB::table('backgrounds')->insert([
            'path' => 'uploads/background/3.jpg',              
        ]);
        DB::table('backgrounds')->insert([
            'path' => 'uploads/background/4.jpg',              
        ]);

        DB::table('meditates')->insert([
            'title' => 'this is image',              
            'description' => 'look at image to think deeply',              
            'image_path' => 'uploads/meditate/1.jpg',              
        ]);
        DB::table('meditates')->insert([
            'title' => 'this is music',              
            'description' => 'listen music to think deeply',              
            'audio_path' => 'uploads/meditate/1.mp3',              
        ]);
    }
}
