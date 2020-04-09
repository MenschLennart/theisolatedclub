<?php

use Illuminate\Database\Seeder;

class CategoriesTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('category_type')->insert([
            [
                'category_id' => 1,
                'type_id' => 1
            ], [
                'category_id' => 1,
                'type_id' => 2
            ], [
                'category_id' => 1,
                'type_id' => 3
            ], [
                'category_id' => 1,
                'type_id' => 4
            ], [
                'category_id' => 1,
                'type_id' => 5
            ], [
                'category_id' => 2,
                'type_id' => 1
            ], [
                'category_id' => 2,
                'type_id' => 2
            ], [
                'category_id' => 2,
                'type_id' => 3
            ], [
                'category_id' => 2,
                'type_id' => 4
            ], [
                'category_id' => 2,
                'type_id' => 5
            ], [
                'category_id' => 3,
                'type_id' => 1
            ], [
                'category_id' => 3,
                'type_id' => 2
            ], [
                'category_id' => 3,
                'type_id' => 3
            ], [
                'category_id' => 3,
                'type_id' => 4
            ], [
                'category_id' => 3,
                'type_id' => 5
            ], [
                'category_id' => 4,
                'type_id' => 1
            ], [
                'category_id' => 4,
                'type_id' => 2
            ], [
                'category_id' => 4,
                'type_id' => 3
            ], [
                'category_id' => 4,
                'type_id' => 4
            ], [
                'category_id' => 4,
                'type_id' => 5
            ], [
                'category_id' => 5,
                'type_id' => 6
            ], [
                'category_id' => 5,
                'type_id' => 7
            ], [
                'category_id' => 5,
                'type_id' => 8
            ], [
                'category_id' => 5,
                'type_id' => 9
            ], [
                'category_id' => 5,
                'type_id' => 10
            ], [
                'category_id' => 5,
                'type_id' => 1
            ], [
                'category_id' => 5,
                'type_id' => 2
            ], [
                'category_id' => 5,
                'type_id' => 3
            ], [
                'category_id' => 5,
                'type_id' => 4
            ], [
                'category_id' => 5,
                'type_id' => 5
            ], [
                'category_id' => 6,
                'type_id' => 1
            ], [
                'category_id' => 6,
                'type_id' => 2
            ], [
                'category_id' => 6,
                'type_id' => 3
            ], [
                'category_id' => 6,
                'type_id' => 4
            ], [
                'category_id' => 6,
                'type_id' => 5
            ], [
                'category_id' => 7,
                'type_id' => 1
            ], [
                'category_id' => 7,
                'type_id' => 2
            ], [
                'category_id' => 7,
                'type_id' => 3
            ], [
                'category_id' => 7,
                'type_id' => 4
            ], [
                'category_id' => 7,
                'type_id' => 5
            ]
        ]);
    }
}
