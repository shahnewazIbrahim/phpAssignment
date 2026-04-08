<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            PermissionSeeder::class,
            RoleSeeder::class,
            UserRoleSeeder::class,
            CategorySeeder::class,
            EmployeeSeeder::class,
            JobSeeder::class,
            AboutSettingSeeder::class,
            BlogSeeder::class,
            CandidateSeeder::class,
            ContactSettingSeeder::class,
            PluginSeeder::class,
            ApplyJobSeeder::class,
        ]);
    }
}
