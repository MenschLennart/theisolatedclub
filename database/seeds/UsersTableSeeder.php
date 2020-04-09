<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    const USER_AMOUNT = 20;

    public function run() {
        factory(App\User::class, self::USER_AMOUNT)->create();
    }
}
