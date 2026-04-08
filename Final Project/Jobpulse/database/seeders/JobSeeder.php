<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companies = User::whereIn('email', ['hr@nexasoft.test', 'jobs@brightfuture.test'])
            ->get()
            ->keyBy('email');

        $jobs = [
            [
                'type' => 'Laravel Developer',
                'salary' => 55000,
                'specialities' => 'PHP, Laravel, MySQL',
                'deadline' => now()->addDays(20)->toDateString(),
                'requirements' => 'Strong Laravel fundamentals, REST API experience, and database design knowledge.',
                'experience' => '2+ years in backend web development.',
                'responsibilities' => 'Build APIs, maintain admin panel features, and optimize SQL queries.',
                'compensations' => 'Festival bonus, lunch support, medical allowance.',
                'location' => 'Dhaka, Bangladesh',
                'employee_status' => 'Full Time',
                'user_id' => $companies['hr@nexasoft.test']->id ?? null,
            ],
            [
                'type' => 'Frontend Developer',
                'salary' => 48000,
                'specialities' => 'JavaScript, Blade, Bootstrap',
                'deadline' => now()->addDays(15)->toDateString(),
                'requirements' => 'Good UI implementation skills and responsive layout experience.',
                'experience' => '1-2 years in frontend development.',
                'responsibilities' => 'Convert designs into pages and improve existing UX flows.',
                'compensations' => 'Performance bonus and hybrid work support.',
                'location' => 'Dhaka, Bangladesh',
                'employee_status' => 'Full Time',
                'user_id' => $companies['hr@nexasoft.test']->id ?? null,
            ],
            [
                'type' => 'HR Executive',
                'salary' => 35000,
                'specialities' => 'Recruitment, Communication, Reporting',
                'deadline' => now()->addDays(12)->toDateString(),
                'requirements' => 'Ability to handle candidate communication and interview coordination.',
                'experience' => 'At least 1 year in HR operations.',
                'responsibilities' => 'Screen CVs, schedule interviews, and maintain hiring pipeline data.',
                'compensations' => 'Provident fund and yearly increment.',
                'location' => 'Chattogram, Bangladesh',
                'employee_status' => 'Full Time',
                'user_id' => $companies['jobs@brightfuture.test']->id ?? null,
            ],
            [
                'type' => 'Content Writer',
                'salary' => 22000,
                'specialities' => 'SEO Writing, Blogging, Editing',
                'deadline' => now()->addDays(10)->toDateString(),
                'requirements' => 'Clear English writing skills with portfolio samples.',
                'experience' => 'Freshers can apply.',
                'responsibilities' => 'Write blog posts, landing page content, and campaign copy.',
                'compensations' => 'Flexible hours and internet allowance.',
                'location' => 'Remote',
                'employee_status' => 'Part time',
                'user_id' => $companies['jobs@brightfuture.test']->id ?? null,
            ],
        ];

        foreach ($jobs as $job) {
            if (!$job['user_id']) {
                continue;
            }

            DB::table('jobs')->updateOrInsert(
                [
                    'type' => $job['type'],
                    'user_id' => $job['user_id'],
                ],
                array_merge($job, [
                    'updated_at' => now(),
                    'created_at' => now(),
                ])
            );
        }
    }
}
