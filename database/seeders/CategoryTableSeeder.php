<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('category')->insert([
        	'name' => 'Fruit and vegetables',
        	'created_at' => NOW(),
        	'updated_at' => NOW()
        ]);
        \DB::table('category')->insert([
        	'name' => 'Meat and Fish',
        	'created_at' => NOW(),
        	'updated_at' => NOW()
        ]);
        \DB::table('category')->insert([
        	'name' => 'Beverages',
        	'created_at' => NOW(),
        	'updated_at' => NOW()
        ]);
        \DB::table('category')->insert([
        	'name' => 'Pets',
        	'created_at' => NOW(),
        	'updated_at' => NOW()
        ]);
    }
}
