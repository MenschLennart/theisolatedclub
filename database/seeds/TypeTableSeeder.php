<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeTableSeeder extends Seeder
{
    public function run() {
        DB::table('types')->insert([
            [
                'title' => 'Video',
            ], [
                'title' => 'App',
            ], [
                'title' => 'Audio',
            ], [
                'title' => 'Article',
            ], [
                'title' => 'Website',
            ], [
                'title' => 'TV',
            ], [
                'title' => 'Netflix',
            ], [
                'title' => 'Disney+',
            ], [
                'title' => 'AppleTV+',
            ], [
                'title' => 'Amazon Prime',
            ],
        ]);
    }
}
