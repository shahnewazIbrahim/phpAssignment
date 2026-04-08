<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'firstName' => 'Owner',
                'lastName' => 'Admin',
                'email' => 'owner@super.admin',
                'mobile' => '01700000000',
                'type' => 'Owner',
            ],
            [
                'firstName' => 'Nexa',
                'lastName' => 'Soft',
                'email' => 'hr@nexasoft.test',
                'mobile' => '01700000001',
                'type' => 'Company',
            ],
            [
                'firstName' => 'Bright',
                'lastName' => 'Future',
                'email' => 'jobs@brightfuture.test',
                'mobile' => '01700000002',
                'type' => 'Company',
            ],
            [
                'firstName' => 'Ayesha',
                'lastName' => 'Rahman',
                'email' => 'ayesha.candidate@test.com',
                'mobile' => '01700000003',
                'type' => 'Candidate',
            ],
            [
                'firstName' => 'Mahin',
                'lastName' => 'Hasan',
                'email' => 'mahin.candidate@test.com',
                'mobile' => '01700000004',
                'type' => 'Candidate',
            ],
            [
                'firstName' => 'Nusrat',
                'lastName' => 'Jahan',
                'email' => 'nusrat.candidate@test.com',
                'mobile' => '01700000005',
                'type' => 'Candidate',
            ],
        ];

        foreach ($users as $user) {
            User::updateOrCreate(
                ['email' => $user['email']],
                [
                    'firstName' => $user['firstName'],
                    'lastName' => $user['lastName'],
                    'mobile' => $user['mobile'],
                    'type' => $user['type'],
                    'password' => Hash::make('password'),
                    'otp' => 0,
                ]
            );
        }
    }
}
