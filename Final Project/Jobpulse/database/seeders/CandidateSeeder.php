<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CandidateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $candidates = User::whereIn('email', [
            'ayesha.candidate@test.com',
            'mahin.candidate@test.com',
            'nusrat.candidate@test.com',
        ])->get();

        $profiles = [
            'ayesha.candidate@test.com' => [
                'image' => 'candidate-ayesha.jpg',
                'address' => 'Mirpur, Dhaka',
                'occupation' => 'Junior Laravel Developer',
                'ssc' => 'SSC, GPA 5.00, Dhaka Board, 2017',
                'hsc' => 'HSC, GPA 4.92, Dhaka Board, 2019',
                'hons' => 'BSc in CSE, Daffodil International University, 2024',
                'other_qualification' => 'Completed REST API and Git training with multiple Laravel practice projects.',
            ],
            'mahin.candidate@test.com' => [
                'image' => 'candidate-mahin.jpg',
                'address' => 'Agrabad, Chattogram',
                'occupation' => 'HR Assistant',
                'ssc' => 'SSC, GPA 4.70, Chattogram Board, 2016',
                'hsc' => 'HSC, GPA 4.60, Chattogram Board, 2018',
                'hons' => 'BBA in HRM, National University, 2023',
                'other_qualification' => 'Experienced in interview scheduling, Excel reporting, and candidate communication.',
            ],
            'nusrat.candidate@test.com' => [
                'image' => 'candidate-nusrat.jpg',
                'address' => 'Uttara, Dhaka',
                'occupation' => 'Content Writer',
                'ssc' => 'SSC, GPA 4.80, Rajshahi Board, 2015',
                'hsc' => 'HSC, GPA 4.75, Rajshahi Board, 2017',
                'hons' => 'BA in English, University of Rajshahi, 2022',
                'other_qualification' => 'Writes SEO articles, website copy, and blog content in both Bangla and English.',
            ],
        ];

        foreach ($candidates as $candidate) {
            $profile = $profiles[$candidate->email] ?? null;

            if (!$profile) {
                continue;
            }

            DB::table('candidates')->updateOrInsert(
                ['user_id' => $candidate->id],
                array_merge($profile, [
                    'updated_at' => now(),
                    'created_at' => now(),
                ])
            );
        }
    }
}
