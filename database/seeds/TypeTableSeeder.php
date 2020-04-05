<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeTableSeeder extends Seeder
{
    public function run() {
        DB::table('types')->insert([
            [
                'id' => 1,
                'title' => 'Video',
            ], [
                'id' => 2,
                'title' => 'App',
            ], [
                'id' => 3,
                'title' => 'Audio',
            ], [
                'id' => 4,
                'title' => 'Article',
            ]
        ]);
    }
}
