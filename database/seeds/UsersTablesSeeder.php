<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\User;

class UsersTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
                [
                    'name'       => 'Admin',
                    'email'      => 'admin@gmail.com',
                    'type'       => 0,
                    'password'   =>  Hash::make('password'),
                ],
                [
                    'name'       => 'mgmg',
                    'email'      => 'mgmg@gmail.com',
                    'type'       => 1,
                    'password'   =>  Hash::make('111111'),
                ],
                [
                    'name'       => 'koko',
                    'email'      => 'koko@gmail.com',
                    'type'       => 1,
                    'password'   =>  Hash::make('111111'),
                ],
                [
                    'name'       => 'mama',
                    'email'      => 'mama@gmail.com',
                    'type'       => 2,
                    'password'   =>  Hash::make('111111'),
                ]
            ]
        );
    }
}
