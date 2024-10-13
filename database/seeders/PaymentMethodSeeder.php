<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // truncate table with foreign key
         DB::statement('SET FOREIGN_KEY_CHECKS=0');
         DB::table('payment_method')->truncate();
 
         $data = [
             ['payment_name' => 'BRI', 'payment_number' => '1234567890', 'payment_provider' => 'BRI', 'created_at' => now(), 'updated_at' => now()],
             ['payment_name' => 'BCA', 'payment_number' => '1834588990', 'payment_provider' => 'BCA', 'created_at' => now(), 'updated_at' => now()],
             ['payment_name' => 'Mandiri', 'payment_number' => '1993567890', 'payment_provider' => 'Mandiri', 'created_at' => now(), 'updated_at' => now()],
             ['payment_name' => 'BNI', 'payment_number' => '1000567890', 'payment_provider' => 'BNI', 'created_at' => now(), 'updated_at' => now()],
         ];
 
         DB::table('payment_method')->insert($data);
    }
}
