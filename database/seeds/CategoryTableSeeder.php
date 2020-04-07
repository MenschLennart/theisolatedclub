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
                'name' => 'Talk & Social',
                'description' => 'Digitale Kommunikation so wichtig wie nie.'
            ], [
                'name' => 'TV & Shows',
                'description' => 'It\'s time to binge watch!'
            ], [
                'name' => 'Classroom',
                'description' => 'Keep your Brain up-to-date.'
            ]
        ]);
    }
}
