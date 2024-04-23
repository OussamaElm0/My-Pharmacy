<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            'id' => 6,
            'name' => 'Superuser'
        ]);

        DB::table('roles')->insert([
            'name' => 'Cashier'
        ]);
        DB::table('roles')->insert([
            'name' => 'Administrator'
        ]);
        DB::table('roles')->insert([
            'name' => 'Invetory manager'
        ]);
    }
}
