<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Carbon\Carbon;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([[
                'name' => 'Admin',
                'created_at' => carbon::now()
        ],
        [
            'name' => 'Employee',
            'created_at' => carbon::now()
        ]]);
    }
}
