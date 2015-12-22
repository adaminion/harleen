<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // no mass assigned rule
        Model::unguard();

        $this->call(GeneralSeeder::class);
        $this->call(ResourcesSeeder::class);

        DB::table('user')->insert([
            'username' => 'dev',
            'password' => bcrypt('a'),
            'role' => 'developer',
        ]);

        DB::table('user')->insert([
            'username' => 'admin',
            'password' => bcrypt('a'),
            'role' => 'administrator',
        ]);

        // TODO: delete this upon production
        DB::table('user')->insert([
            'working_area_id' => 'WK1001',
            'username' => 'wk1001',
            'password' => bcrypt('a'),
            'role' => 'contractor',
        ]);

    }
}