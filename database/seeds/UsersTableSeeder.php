<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    public function run() {
        DB::table('users')->insert(
            [
                'name' => 'Seyi',
                'email' => 'seyii@seyi.com',
                'password' => 'somerandompassword'
            ]
        );

        DB::table('activities')->insert([
            [
                'title' => 'Game Activity',
                'content' => 'Lorem ipsum dolor sit ammet',
                'link' => 'http://www.test.de',
                'category_id' => 1,
                'type_id' => 1,
                'user_id' => 1
            ],
            [
                'title' => 'Game Activity',
                'content' => 'Lorem ipsum dolor sit ammet',
                'link' => 'http://www.test.de',
                'category_id' => 1,
                'type_id' => 2,
                'user_id' => 1
            ],
            [
                'title' => 'Game Activity',
                'content' => 'Lorem ipsum dolor sit ammet',
                'link' => 'http://www.test.de',
                'category_id' => 1,
                'type_id' => 3,
                'user_id' => 1
            ],
            [
                'title' => 'Game Activity',
                'content' => 'Lorem ipsum dolor sit ammet',
                'link' => 'http://www.test.de',
                'category_id' => 1,
                'type_id' => 3,
                'user_id' => 1
            ],
            [
                'title' => 'Game Activity',
                'content' => 'Lorem ipsum dolor sit ammet',
                'link' => 'http://www.test.de',
                'category_id' => 1,
                'type_id' => 4,
                'user_id' => 1
            ],
            [
                'title' => 'Game Activity',
                'content' => 'Lorem ipsum dolor sit ammet',
                'link' => 'http://www.test.de',
                'category_id' => 1,
                'type_id' => 2,
                'user_id' => 1
            ],
            [
                'title' => 'Game Activity',
                'content' => 'Lorem ipsum dolor sit ammet',
                'link' => 'http://www.test.de',
                'category_id' => 1,
                'type_id' => 3,
                'user_id' => 1
            ],
            [
                'title' => 'Game Activity',
                'content' => 'Lorem ipsum dolor sit ammet',
                'link' => 'http://www.test.de',
                'category_id' => 1,
                'type_id' => 2,
                'user_id' => 1
            ],
            [
                'title' => 'Sports Activity',
                'content' => 'lorem ipsum dolor sit ammet',
                'link' => 'http://www.test.de',
                'category_id' => 2,
                'type_id' => 1,
                'user_id' => 1
            ],
            [
                'title' => 'Sports Activity',
                'content' => 'lorem ipsum dolor sit ammet',
                'link' => 'http://www.test.de',
                'category_id' => 2,
                'type_id' => 2,
                'user_id' => 1
            ],
            [
                'title' => 'Sports Activity',
                'content' => 'lorem ipsum dolor sit ammet',
                'link' => 'http://www.test.de',
                'category_id' => 2,
                'type_id' => 2,
                'user_id' => 1
            ],
            [
                'title' => 'Sports Activity',
                'content' => 'lorem ipsum dolor sit ammet',
                'link' => 'http://www.test.de',
                'category_id' => 2,
                'type_id' => 3,
                'user_id' => 1
            ],
            [
                'title' => 'Sports Activity',
                'content' => 'lorem ipsum dolor sit ammet',
                'link' => 'http://www.test.de',
                'category_id' => 2,
                'type_id' => 4,
                'user_id' => 1
            ],
            [
                'title' => 'Sports Activity',
                'content' => 'lorem ipsum dolor sit ammet',
                'link' => 'http://www.test.de',
                'category_id' => 2,
                'type_id' => 4,
                'user_id' => 1
            ],
            [
                'title' => 'Sports Activity',
                'content' => 'lorem ipsum dolor sit ammet',
                'link' => 'http://www.test.de',
                'category_id' => 2,
                'type_id' => 3,
                'user_id' => 1
            ],
            [
                'title' => 'Sports Activity',
                'content' => 'lorem ipsum dolor sit ammet',
                'link' => 'http://www.test.de',
                'category_id' => 2,
                'type_id' => 1,
                'user_id' => 1
            ],[
                'title' => 'Food Activity',
                'content' => 'lorem ipsum dolor sit ammet',
                'link' => 'http://www.test.de',
                'category_id' => 3,
                'type_id' => 3,
                'user_id' => 1
            ],[
                'title' => 'Food Activity',
                'content' => 'lorem ipsum dolor sit ammet',
                'link' => 'http://www.test.de',
                'category_id' => 3,
                'type_id' => 1,
                'user_id' => 1
            ],[
                'title' => 'Food Activity',
                'content' => 'lorem ipsum dolor sit ammet',
                'link' => 'http://www.test.de',
                'category_id' => 3,
                'type_id' => 1,
                'user_id' => 1
            ],[
                'title' => 'Food Activity',
                'content' => 'lorem ipsum dolor sit ammet',
                'link' => 'http://www.test.de',
                'category_id' => 3,
                'type_id' => 2,
                'user_id' => 1
            ],[
                'title' => 'Food Activity',
                'content' => 'lorem ipsum dolor sit ammet',
                'link' => 'http://www.test.de',
                'category_id' => 3,
                'type_id' => 3,
                'user_id' => 1
            ],[
                'title' => 'Food Activity',
                'content' => 'lorem ipsum dolor sit ammet',
                'link' => 'http://www.test.de',
                'category_id' => 3,
                'type_id' => 4,
                'user_id' => 1
            ],[
                'title' => 'Food Activity',
                'content' => 'lorem ipsum dolor sit ammet',
                'link' => 'http://www.test.de',
                'category_id' => 3,
                'type_id' => 1,
                'user_id' => 1
            ], [
                'title' => 'Communication Activity',
                'content' => 'lorem ipsum dolor sit ammet',
                'link' => 'http://www.test.de',
                'category_id' => 4,
                'type_id' => 4,
                'user_id' => 1
            ], [
                'title' => 'Communication Activity',
                'content' => 'lorem ipsum dolor sit ammet',
                'link' => 'http://www.test.de',
                'category_id' => 4,
                'type_id' => 2,
                'user_id' => 1
            ], [
                'title' => 'Communication Activity',
                'content' => 'lorem ipsum dolor sit ammet',
                'link' => 'http://www.test.de',
                'category_id' => 4,
                'type_id' => 2,
                'user_id' => 1
            ], [
                'title' => 'Communication Activity',
                'content' => 'lorem ipsum dolor sit ammet',
                'link' => 'http://www.test.de',
                'category_id' => 4,
                'type_id' => 3,
                'user_id' => 1
            ], [
                'title' => 'Communication Activity',
                'content' => 'lorem ipsum dolor sit ammet',
                'link' => 'http://www.test.de',
                'category_id' => 4,
                'type_id' => 3,
                'user_id' => 1
            ], [
                'title' => 'Communication Activity',
                'content' => 'lorem ipsum dolor sit ammet',
                'link' => 'http://www.test.de',
                'category_id' => 4,
                'type_id' => 1,
                'user_id' => 1
            ], [
                'title' => 'Communication Activity',
                'content' => 'lorem ipsum dolor sit ammet',
                'link' => 'http://www.test.de',
                'category_id' => 4,
                'type_id' => 3,
                'user_id' => 1
            ], [
                'title' => 'Communication Activity',
                'content' => 'lorem ipsum dolor sit ammet',
                'link' => 'http://www.test.de',
                'category_id' => 4,
                'type_id' => 4,
                'user_id' => 1
            ]
        ]);
    }
}
