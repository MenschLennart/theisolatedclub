<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryTableSeeder extends Seeder
{
    public function run() {
        DB::table('categories')->insert([
            [
                'name' => 'Games',
                'description' => 'Spiele allein, mit Freunden, der Familie, oder mit der ganzen Welt.'
            ], [
                'name' => 'Sport & Wellness',
                'description' => 'Bleibe Gesund, Fit und im Einklang. Auch von zu Hause aus.'
            ], [
                'name' => 'Food & Recipes',
                'description' => 'Tolle Rezepteideen und aktuelle Trends.'
            ], [
                'name' => 'Communications',
                'description' => 'Digitale Kommunikation so wichtig wie nie.'
            ]
        ]);
    }
}
