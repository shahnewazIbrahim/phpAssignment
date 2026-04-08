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
        $users = User::whereIn('email', [
            'hr@nexasoft.test',
            'jobs@brightfuture.test',
        ])->get()->keyBy('email');

        if ($users->isEmpty()) {
            return;
        }

        $plugins = [
            [
                'name' => 'Blog Management',
                'slug' => 'blog_management',
                'description' => 'Allows a company to use the Blog module from the dashboard and publish employer-written posts.',
                'active' => 1,
                'user_id' => $users['hr@nexasoft.test']->id ?? null,
            ],
            [
                'name' => 'Featured Jobs',
                'slug' => 'featured_jobs',
                'description' => 'Highlights the company\'s jobs on the homepage and job listings so openings get more visibility.',
                'active' => 1,
                'user_id' => $users['jobs@brightfuture.test']->id ?? null,
            ],
        ];

        foreach ($plugins as $plugin) {
            if (!$plugin['user_id']) {
                continue;
            }

            DB::table('plugins')->updateOrInsert(
                [
                    'slug' => $plugin['slug'],
                    'user_id' => $plugin['user_id'],
                ],
                [
                    'name' => $plugin['name'],
                    'description' => $plugin['description'],
                    'active' => $plugin['active'],
                    'user_id' => $plugin['user_id'],
                    'updated_at' => now(),
                    'created_at' => now(),
                ]
            );
        }
    }
}
