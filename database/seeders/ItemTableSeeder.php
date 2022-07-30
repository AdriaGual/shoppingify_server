<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ItemTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('item')->insert([
        	'name' => 'Avocado',
        	'note' => 'Avocado',
            'category_id' => 1,
        	'created_at' => NOW(),
        	'updated_at' => NOW()
        ]);
        \DB::table('item')->insert([
        	'name' => 'Banana',
        	'note' => 'Banana',
            'category_id' => 1,
        	'created_at' => NOW(),
        	'updated_at' => NOW()
        ]);
        \DB::table('item')->insert([
        	'name' => 'Chicken leg box',
        	'note' => 'Chicken leg box',
            'category_id' => 2,
        	'created_at' => NOW(),
        	'updated_at' => NOW()
        ]);
        \DB::table('item')->insert([
        	'name' => 'Chicken',
        	'note' => 'Chicken',
            'category_id' => 3,
        	'created_at' => NOW(),
        	'updated_at' => NOW()
        ]);
    }
}
