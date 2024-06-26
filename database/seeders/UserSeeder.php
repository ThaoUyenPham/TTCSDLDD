<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Hash;
use DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data=[
            'name' => 'admin',
            'username'=>"admin",
            'email' => Str::random(10).'@example.com',
            'password' => Hash::make('123'),
        ];
        DB::table('users')->insert($data);        
    }
}
