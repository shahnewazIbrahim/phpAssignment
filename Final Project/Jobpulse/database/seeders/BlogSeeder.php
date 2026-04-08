<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $owner = User::where('email', 'owner@super.admin')->first();
        $company = User::where('email', 'hr@nexasoft.test')->first();

        $blogs = [
            [
                'text' => '<h2>How to prepare for a junior developer interview</h2><p>Focus on HTML, CSS, JavaScript fundamentals, problem solving, and clear communication about projects you have built.</p>',
                'user_id' => $owner?->id,
            ],
            [
                'text' => '<h2>What companies expect from a complete candidate profile</h2><p>Add education history, occupation details, portfolio links, and a short summary that makes your strengths easy to scan.</p>',
                'user_id' => $company?->id,
            ],
            [
                'text' => '<h2>Hiring trends for 2026</h2><p>Employers are prioritizing practical skills, clean communication, and candidates who can show consistent work samples.</p>',
                'user_id' => $owner?->id,
            ],
        ];

        foreach ($blogs as $blog) {
            if (!$blog['user_id']) {
                continue;
            }

            DB::table('blogs')->updateOrInsert(
                [
                    'user_id' => $blog['user_id'],
                    'text' => $blog['text'],
                ],
                [
                    'updated_at' => now(),
                    'created_at' => now(),
                ]
            );
        }
    }
}
