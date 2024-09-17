<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InvestmentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Insert Data to Investment Type
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('investment_type')->truncate();

        $investmentTypes = [
            ['name' => 'Breeding', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Fattening', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Growing', 'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('investment_type')->insert($investmentTypes);
    }
}
