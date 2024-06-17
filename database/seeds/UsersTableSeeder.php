<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('users')->insert(
            array(
                array(
                    'name'=> 'Developer',
                    'email'=> 'developer@gmail.com',
                    'username'=> 'developer',
                    'status'=> 'active',
                    'role'=>'superadmin',
                    'password'=> bcrypt('superAdmin'),
                    'decrypt_pw'=>'',
                    'image'=> 'avatar.jpg',
                    'is_new' => '0',
                    'is_verified' => 1,
                    'created_at'=> \Carbon\Carbon::now(),
                    'updated_at'=> \Carbon\Carbon::now()
                ),
                array(
                    'name'=> 'Superadmin',
                    'email'=> 'info@klientscape.com',
                    'username'=> 'superadmin',
                    'status'=> 'active',
                    'role'=>'admin',
                    'image'=> '1623762339.jpg',
                    'password'=> bcrypt('klientscape'),
                    'decrypt_pw'=>'klientscape',
                    'is_new' => '0',
                    'is_verified' => 1,
                    'created_at'=> \Carbon\Carbon::now(),
                    'updated_at'=> \Carbon\Carbon::now()
                ),
                array(
                    'name'=> 'Laukush Chaudhary',
                    'email'=> 'laukush@klientscape.com',
                    'username'=> 'laukush',
                    'status'=> 'active',
                    'role'=>'staff',
                    'image'=> '',
                    'password'=> bcrypt('klientscape'),
                    'decrypt_pw'=>'klientscape',
                    'is_new' => '1',
                    'is_verified' => 1,
                    'created_at'=> \Carbon\Carbon::now(),
                    'updated_at'=> \Carbon\Carbon::now()
                ),
                array(
                    'name'=> 'Mallika Maharjan',
                    'email'=> 'mallika@klientscape.com',
                    'username'=> 'mallika',
                    'status'=> 'active',
                    'role'=>'staff',
                    'image'=> '',
                    'password'=> bcrypt('klientscape'),
                    'decrypt_pw'=>'klientscape',
                    'is_new' => '1',
                    'is_verified' => 1,
                    'created_at'=> \Carbon\Carbon::now(),
                    'updated_at'=> \Carbon\Carbon::now()
                ),
                array(
                    'name'=> 'Ojash Thapa',
                    'email'=> 'ojash@klientscape.com',
                    'username'=> 'ojash',
                    'status'=> 'active',
                    'role'=>'staff',
                    'image'=> '',
                    'password'=> bcrypt('klientscape'),
                    'decrypt_pw'=>'klientscape',
                    'is_new' => '1',
                    'is_verified' => 1,
                    'created_at'=> \Carbon\Carbon::now(),
                    'updated_at'=> \Carbon\Carbon::now()
                ),
                array(
                    'name'=> 'Sajana Mainali',
                    'email'=> 'sajana@klientscape.com',
                    'username'=> 'sajana',
                    'status'=> 'active',
                    'role'=>'staff',
                    'image'=> '',
                    'password'=> bcrypt('klientscape'),
                    'decrypt_pw'=>'klientscape',
                    'is_new' => '1',
                    'is_verified' => 1,
                    'created_at'=> \Carbon\Carbon::now(),
                    'updated_at'=> \Carbon\Carbon::now()
                ),
                array(
                    'name'=> 'Bikalpa Bhurtel',
                    'email'=> 'bikalpa@klientscape.com',
                    'username'=> 'bikalpa',
                    'status'=> 'active',
                    'role'=>'staff',
                    'image'=> '',
                    'password'=> bcrypt('klientscape'),
                    'decrypt_pw'=>'klientscape',
                    'is_new' => '1',
                    'is_verified' => 1,
                    'created_at'=> \Carbon\Carbon::now(),
                    'updated_at'=> \Carbon\Carbon::now()
                ),
                array(
                    'name'=> 'Kishor Subedi',
                    'email'=> 'kishor@klientscape.com',
                    'username'=> 'kishor',
                    'status'=> 'active',
                    'role'=>'staff',
                    'image'=> '',
                    'password'=> bcrypt('klientscape'),
                    'decrypt_pw'=>'klientscape',
                    'is_new' => '1',
                    'is_verified' => 1,
                    'created_at'=> \Carbon\Carbon::now(),
                    'updated_at'=> \Carbon\Carbon::now()
                )
            ));
    }
}
