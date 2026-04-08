<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PluginSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $owner = User::where('email', 'owner@super.admin')->first();

        if (!$owner) {
            return;
        }

        $plugins = [
            ['name' => 'Resume Parser', 'active' => 1],
            ['name' => 'Featured Jobs Carousel', 'active' => 1],
            ['name' => 'Email Notification Center', 'active' => 0],
            ['name' => 'Advanced Candidate Filter', 'active' => 0],
        ];

        foreach ($plugins as $plugin) {
            DB::table('plugins')->updateOrInsert(
                ['name' => $plugin['name']],
                [
                    'active' => $plugin['active'],
                    'user_id' => $owner->id,
                    'updated_at' => now(),
                    'created_at' => now(),
                ]
            );
        }
    }
}
