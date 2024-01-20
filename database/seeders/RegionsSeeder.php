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
            'name' => 'Americas',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Db::table('regions')->insert([
            'name' => 'Europe',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Db::table('regions')->insert([
            'name' => 'Korea',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('regions')->insert([
            'name' => 'China',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
