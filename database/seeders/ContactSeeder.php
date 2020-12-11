<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class ContactSeeder extends Seeder
{
    public function run()
    {
        DB::table('contact')->insert([
            'name' => 'Alice',
            'email' => 'liceu.l@gmail.com',
            'phone' => '778457856589',
        ]);
    }
}
