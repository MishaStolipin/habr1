<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTAbleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data=[[
            'name'      =>'Автор не известен',
            'email'     =>'author_unknown@.g',
            'password'  =>bcrypt(str_random(16)),
        ],
        [
            'name'      =>'Автор',
            'email'     =>'autor1@g',
            'password'  =>bcrypt('123123'),
        ],
    ];
      DB::table('users')->insert($data);
    }
}
