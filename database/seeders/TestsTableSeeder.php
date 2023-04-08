<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TestsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tests')->insert([
            [
                'text' => 'aaa',
                'created_at' => now()
            ],
            [
                'text' => 'bbb',
                'created_at' => now()
            ],
            [
                'text' => 'ccc',
                'created_at' => now()
            ]
        ]);
    }
}
