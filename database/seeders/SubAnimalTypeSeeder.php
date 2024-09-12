<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubAnimalTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // truncate table with foreign key
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('sub_animal_type')->truncate();
        
        $SubAnimalType = [
            ['id_animal_type' => '1', 'name' => 'Bali', 'created_at' => now(), 'updated_at' => now()],
            ['id_animal_type' => '1', 'name' => 'Madura', 'created_at' => now(), 'updated_at' => now()],
            ['id_animal_type' => '1', 'name' => 'Simental', 'created_at' => now(), 'updated_at' => now()],
            ['id_animal_type' => '2', 'name' => 'Boer', 'created_at' => now(), 'updated_at' => now()],
            ['id_animal_type' => '2', 'name' => 'Etawa', 'created_at' => now(), 'updated_at' => now()],
            ['id_animal_type' => '2', 'name' => 'Peranakan', 'created_at' => now(), 'updated_at' => now()],
            ['id_animal_type' => '3', 'name' => 'Garut', 'created_at' => now(), 'updated_at' => now()],
            ['id_animal_type' => '3', 'name' => 'Jawa', 'created_at' => now(), 'updated_at' => now()],
            ['id_animal_type' => '3', 'name' => 'Merino', 'created_at' => now(), 'updated_at' => now()],
            ['id_animal_type' => '4', 'name' => 'Bali', 'created_at' => now(), 'updated_at' => now()],
            ['id_animal_type' => '4', 'name' => 'Madura', 'created_at' => now(), 'updated_at' => now()],
            ['id_animal_type' => '4', 'name' => 'Simental', 'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('sub_animal_type')->insert($SubAnimalType);
    }
}
