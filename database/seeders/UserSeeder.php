<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // truncate table with foreign key
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('users')->truncate();


        $users = [
            [
                'username'      => 'adiaulia',
                'email'         => 'adi@gmail.com',
                'password'      => password_hash('pelaihari', PASSWORD_DEFAULT),
                'level'         => 'investor',
                'is_active'     => 1,
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'username'      => 'ternak',
                'email'         => 'ternak@gmail.com',
                'password'      => password_hash('pelaihari', PASSWORD_DEFAULT),
                'level'         => 'mitra',
                'is_active'     => 1,
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'username'      => 'ahmad',
                'email'         => 'ahmad@gmail.com',
                'password'      => password_hash('pelaihari', PASSWORD_DEFAULT),
                'level'         => 'investor',
                'is_active'     => 1,
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'username'      => 'admin01',
                'email'         => 'admin01@gmail.com',
                'password'      => password_hash('pelaihari', PASSWORD_DEFAULT),
                'level'         => 'admin',
                'is_active'     => 1,
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'username'      => 'admin02',
                'email'         => 'admin02@gmail.com',
                'password'      => password_hash('pelaihari', PASSWORD_DEFAULT),
                'level'         => 'admin',
                'is_active'     => 1,
                'created_at'    => now(),
                'updated_at'    => now()
            ]
        ];

        DB::table('users')->insert($users);
    }
}
