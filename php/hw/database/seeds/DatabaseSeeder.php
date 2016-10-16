<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        DB::table('subjects')->insert(['name' => 'Математика']);
        DB::table('subjects')->insert(['name' => 'Физика']);
        DB::table('subjects')->insert(['name' => 'Химия']);
        DB::table('subjects')->insert(['name' => 'Программирование']);
    }
}
