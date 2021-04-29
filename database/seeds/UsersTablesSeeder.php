<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
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
                    'phone'      => '0945645612',
                    'address'    => 'yangon',
                    'dob'        => '1993-04-30',
                    'create_user_id' => 1,
                    'created_at'  => Carbon::now(),
                    'updated_at' => Carbon::now(),
                    'password'   =>  Hash::make('password'),
                ],
                [
                    'name'       => 'mgmg',
                    'email'      => 'mgmg@gmail.com',
                    'type'       => 1,
                    'phone'      => '093242335',
                    'address'    => 'mandalay',
                    'dob'        => '1995-01-12',
                    'create_user_id' => 1,
                    'created_at'  => Carbon::now(),
                    'updated_at' => Carbon::now(),
                    'password'   =>  Hash::make('111111'),
                ],
                [
                    'name'       => 'koko',
                    'email'      => 'koko@gmail.com',
                    'type'       => 1,
                    'phone'      => '091646466',
                    'address'    => 'naypyitaw',
                    'dob'        => '1990-12-01',
                    'create_user_id' => 1,
                    'created_at'  => Carbon::now(),
                    'updated_at' => Carbon::now(),
                    'password'   =>  Hash::make('111111'),
                ],
                [
                    'name'       => 'mama',
                    'email'      => 'mama@gmail.com',
                    'type'       => 2,
                    'phone'      => '091245656',
                    'address'    => 'pyinoolwin',
                    'dob'        => '1996-06-26',
                    'create_user_id' => 1,
                    'created_at'  => Carbon::now(),
                    'updated_at' => Carbon::now(),
                    'password'   =>  Hash::make('111111'),
                ]
            ]
        );
    }
}
