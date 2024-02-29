<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (!DB::table('roles')->where('name', 'Owner')->exists()) {
            DB::table('roles')->insert([
                [
                    'name'          => 'Owner',
                    'guard_name'    => 'web',
                    'created_at'    => now(),
                    'updated_at'    => now(),
                ]
            ]);
        }

        if (!DB::table('roles')->where('name', 'Company')->exists()) {
            DB::table('roles')->insert([
                [
                    'name'          => 'Company',
                    'guard_name'    => 'web',
                    'created_at'    => now(),
                    'updated_at'    => now(),
                ]
            ]);
        }
        if (!DB::table('roles')->where('name', 'Candidate')->exists()) {
            DB::table('roles')->insert([
                [
                    'name'          => 'Candidate',
                    'guard_name'    => 'web',
                    'created_at'    => now(),
                    'updated_at'    => now(),
                ]
            ]);
        }
    }
}
