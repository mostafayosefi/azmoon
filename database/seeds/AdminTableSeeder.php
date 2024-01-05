<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class UserTableSeeder extends Seeder{

    public function run(){

        \App\User::create([
            'email'    => 'user@example.com',
            'password' => Hash::make('password')
            ]
        );
    }
}