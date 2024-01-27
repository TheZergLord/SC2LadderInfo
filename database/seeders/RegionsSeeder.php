<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RegionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Db::table('regions')->insert([
            'id' => 1,
            'name' => 'Americas',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Db::table('regions')->insert([
            'id' => 2,
            'name' => 'Europe',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Db::table('regions')->insert([
            'id' => 3,
            'name' => 'Korea/Taiwan',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('regions')->insert([
            'id' => 5,
            'name' => 'China',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
