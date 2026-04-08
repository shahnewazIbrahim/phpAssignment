<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ApplyJobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::whereIn('email', [
            'ayesha.candidate@test.com',
            'mahin.candidate@test.com',
            'nusrat.candidate@test.com',
        ])->get()->keyBy('email');

        $jobs = DB::table('jobs')->pluck('id', 'type');

        $applications = [
            [
                'user_id' => $users['ayesha.candidate@test.com']->id ?? null,
                'job_id' => $jobs['Laravel Developer'] ?? null,
                'accept' => 1,
            ],
            [
                'user_id' => $users['ayesha.candidate@test.com']->id ?? null,
                'job_id' => $jobs['Frontend Developer'] ?? null,
                'accept' => 0,
            ],
            [
                'user_id' => $users['mahin.candidate@test.com']->id ?? null,
                'job_id' => $jobs['HR Executive'] ?? null,
                'accept' => 0,
            ],
            [
                'user_id' => $users['nusrat.candidate@test.com']->id ?? null,
                'job_id' => $jobs['Content Writer'] ?? null,
                'accept' => 1,
            ],
        ];

        foreach ($applications as $application) {
            if (!$application['user_id'] || !$application['job_id']) {
                continue;
            }

            DB::table('apply_jobs')->updateOrInsert(
                [
                    'user_id' => $application['user_id'],
                    'job_id' => $application['job_id'],
                ],
                [
                    'accept' => $application['accept'],
                    'updated_at' => now(),
                    'created_at' => now(),
                ]
            );
        }
    }
}
