<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $now = Carbon::now();

        DB::table('users')->insert([
            'name'       => 'Super Admin',
            'email'      => 'superadmin@example.com',
            'password'   => Hash::make('password'),
            'company_id' => null,
            'role'       => 'SuperAdmin',
            'created_at' => $now,
            'updated_at'  => $now
        ]);

        $peopleTechId = DB::table('companies')->insertGetId([
            'name'           => 'PeopleTech Groups',
            'created_at'  => $now,
            'updated_at'   => $now
        ]);

        $vmaxId = DB::table('companies')->insertGetId([
            'name'          => 'Vmax india e-solution pvt limited',
            'created_at' => $now,
            'updated_at'   => $now
        ]);

        $sembarkId = DB::table('companies')->insertGetId([
            'name'         => 'Sembark Tech pvt limited',
            'created_at' => $now,
            'updated_at'    => $now
        ]);


        DB::table('users')->insert([
            [

                'name'       => 'Admin One',
                'email'      => 'admin1@example.com',
                'password'   => Hash::make('password'),
                'company_id' => $peopleTechId,
                'role'       => 'Admin',
                'created_at' => $now,
                'updated_at'  => $now


            ],

            [
                'name'       => 'Admin Two',
                'email'      => 'admin2@example.com',
                'password'   => Hash::make('password'),
                'company_id' => $vmaxId,
                'role'       => 'Admin',
                'created_at' => $now,
                'updated_at' => $now
            ]
        ]);


        DB::table('users')->insert([
            [
                'name'       => 'Member One',
                'email'      => 'member1@example.com',
                'password'   => Hash::make('password'),
                'company_id' => $peopleTechId,
                'role'       => 'Member',
                'created_at' => $now,
                'updated_at' => $now
            ],
            
            [
                'name'       => 'Member Two',
                'email'      => 'member2@example.com',
                'password'   => Hash::make('password'),
                'company_id' => $vmaxId,
                'role'       => 'Member',
                'created_at' => $now,
                'updated_at' => $now
            ],

            [
                'name'       => 'Member Three',
                'email'      => 'member3@example.com',
                'password'   => Hash::make('password'),
                'company_id' => $sembarkId,
                'role'       => 'Member',
                'created_at' => $now,
                'updated_at' => $now
            ]
        ]);

    }
}
