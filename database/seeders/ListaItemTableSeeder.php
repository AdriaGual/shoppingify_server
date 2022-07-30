<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ListaItemTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('item_list')->insert([
        	'item_id' => 1,
        	'lista_id' => 1,
        	'created_at' => NOW(),
        	'updated_at' => NOW()
        ]);
        \DB::table('item_list')->insert([
        	'item_id' => 1,
        	'lista_id' => 2,
        	'created_at' => NOW(),
        	'updated_at' => NOW()
        ]);
        \DB::table('item_list')->insert([
        	'item_id' => 2,
        	'lista_id' => 1,
        	'created_at' => NOW(),
        	'updated_at' => NOW()
        ]);
        \DB::table('item_list')->insert([
        	'item_id' => 2,
        	'lista_id' => 2,
        	'created_at' => NOW(),
        	'updated_at' => NOW()
        ]);
        \DB::table('item_list')->insert([
        	'item_id' => 3,
        	'lista_id' => 1,
        	'created_at' => NOW(),
        	'updated_at' => NOW()
        ]);
        \DB::table('item_list')->insert([
        	'item_id' => 4,
        	'lista_id' => 3,
        	'created_at' => NOW(),
        	'updated_at' => NOW()
        ]);
        
    }
}
