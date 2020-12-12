<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContactSeeder extends Seeder {

    public function run() {
        DB::table('contact')->insert([
            'name' => 'Alice',
            'email' => 'liceu.l@gmail.com',
            'phone' => '778457856589'
        ]);
        DB::table('contact')->insert([
            'name' => 'Igor',
            'email' => 'igorjoaquim.pg@gmail.com',
            'phone' => '79999901734'
        ]);
    }
}
