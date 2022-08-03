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
        	'name' => 'Bunch of carrots 5pcs',
        	'note' => 'Bunch of carrots 5pcs',
            'category_id' => 1,
        	'created_at' => NOW(),
        	'updated_at' => NOW()
        ]);
        \DB::table('item')->insert([
        	'name' => 'Chicken 1kg',
        	'note' => 'Chicken 1kg',
            'category_id' => 1,
        	'created_at' => NOW(),
        	'updated_at' => NOW()
        ]);
        \DB::table('item')->insert([
        	'name' => 'Pre-cooked corn 450g',
        	'note' => 'Pre-cooked corn 450g',
            'category_id' => 1,
        	'created_at' => NOW(),
        	'updated_at' => NOW()
        ]);
        \DB::table('item')->insert([
        	'name' => 'Mandarin Nadorcott',
        	'note' => 'Mandarin Nadorcott',
            'category_id' => 1,
        	'created_at' => NOW(),
        	'updated_at' => NOW()
        ]);
        \DB::table('item')->insert([
        	'name' => 'Piele De Sapo Melon',
        	'note' => 'Piele De Sapo Melon',
            'category_id' => 1,
        	'created_at' => NOW(),
        	'updated_at' => NOW()
        ]);
        \DB::table('item')->insert([
        	'name' => 'Watermelon',
        	'note' => 'Watermelon',
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
        	'name' => 'Chicken 1kg',
        	'note' => 'Chicken 1kg',
            'category_id' => 2,
        	'created_at' => NOW(),
        	'updated_at' => NOW()
        ]);
        \DB::table('item')->insert([
        	'name' => 'Pork fillets 450g',
        	'note' => 'Pork fillets 450g',
            'category_id' => 2,
        	'created_at' => NOW(),
        	'updated_at' => NOW()
        ]);
        \DB::table('item')->insert([
        	'name' => 'Salmon 1kg',
        	'note' => 'Salmon 1kg',
            'category_id' => 2,
        	'created_at' => NOW(),
        	'updated_at' => NOW()
        ]);
        \DB::table('item')->insert([
        	'name' => 'Avocado',
        	'note' => 'Avocado',
            'category_id' => 3,
        	'created_at' => NOW(),
        	'updated_at' => NOW()
        ]);
        \DB::table('item')->insert([
        	'name' => 'Banana',
        	'note' => 'Banana',
            'category_id' => 3,
        	'created_at' => NOW(),
        	'updated_at' => NOW()
        ]);
        \DB::table('item')->insert([
        	'name' => 'Bunch of carrots 5pcs',
        	'note' => 'Bunch of carrots 5pcs',
            'category_id' => 3,
        	'created_at' => NOW(),
        	'updated_at' => NOW()
        ]);
        \DB::table('item')->insert([
        	'name' => 'Chicken 1kg',
        	'note' => 'Chicken 1kg',
            'category_id' => 3,
        	'created_at' => NOW(),
        	'updated_at' => NOW()
        ]);
        \DB::table('item')->insert([
        	'name' => 'Pre-cooked corn 450g',
        	'note' => 'Pre-cooked corn 450g',
            'category_id' => 3,
        	'created_at' => NOW(),
        	'updated_at' => NOW()
        ]);
        \DB::table('item')->insert([
        	'name' => 'Mandarin Nadorcott',
        	'note' => 'Mandarin Nadorcott',
            'category_id' => 3,
        	'created_at' => NOW(),
        	'updated_at' => NOW()
        ]);
        \DB::table('item')->insert([
        	'name' => 'Piele De Sapo Melon',
        	'note' => 'Piele De Sapo Melon',
            'category_id' => 3,
        	'created_at' => NOW(),
        	'updated_at' => NOW()
        ]);
        \DB::table('item')->insert([
        	'name' => 'Watermelon',
        	'note' => 'Watermelon',
            'category_id' => 3,
        	'created_at' => NOW(),
        	'updated_at' => NOW()
        ]);
    }
}
