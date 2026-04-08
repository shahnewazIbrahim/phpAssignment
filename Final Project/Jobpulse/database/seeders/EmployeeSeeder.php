<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companies = User::whereIn('email', ['hr@nexasoft.test', 'jobs@brightfuture.test'])
            ->get()
            ->keyBy('email');

        $employees = [
            [
                'name' => 'Shafayat Karim',
                'email' => 'shafayat@nexasoft.test',
                'mobile' => '01810000001',
                'user_id' => $companies['hr@nexasoft.test']->id ?? null,
            ],
            [
                'name' => 'Tania Sultana',
                'email' => 'tania@nexasoft.test',
                'mobile' => '01810000002',
                'user_id' => $companies['hr@nexasoft.test']->id ?? null,
            ],
            [
                'name' => 'Nabil Chowdhury',
                'email' => 'nabil@brightfuture.test',
                'mobile' => '01810000003',
                'user_id' => $companies['jobs@brightfuture.test']->id ?? null,
            ],
            [
                'name' => 'Farzana Haque',
                'email' => 'farzana@brightfuture.test',
                'mobile' => '01810000004',
                'user_id' => $companies['jobs@brightfuture.test']->id ?? null,
            ],
        ];

        foreach ($employees as $employee) {
            if (!$employee['user_id']) {
                continue;
            }

            DB::table('employees')->updateOrInsert(
                ['email' => $employee['email']],
                [
                    'name' => $employee['name'],
                    'mobile' => $employee['mobile'],
                    'user_id' => $employee['user_id'],
                    'updated_at' => now(),
                    'created_at' => now(),
                ]
            );
        }
    }
}
