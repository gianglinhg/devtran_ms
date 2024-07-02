<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
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
        DB::table('users')->insert([
            'username' => 'linhbq89',
            'name' => 'Giang Văn Linh',
            'email' => 'linhbq89@gmail.com',
            'password' => Hash::make('giangVL.2001'),
            'department_id' => 1,
            'status_id' => 2
        ]);
    }
}
