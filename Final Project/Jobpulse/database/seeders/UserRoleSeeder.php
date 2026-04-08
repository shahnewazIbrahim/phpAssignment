<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = DB::table('roles')->pluck('id', 'name');

        $assignments = [
            'owner@super.admin' => 'Owner',
            'hr@nexasoft.test' => 'Company',
            'jobs@brightfuture.test' => 'Company',
            'ayesha.candidate@test.com' => 'Candidate',
            'mahin.candidate@test.com' => 'Candidate',
            'nusrat.candidate@test.com' => 'Candidate',
        ];

        foreach ($assignments as $email => $roleName) {
            $user = User::where('email', $email)->first();
            $roleId = $roles[$roleName] ?? null;

            if (!$user || !$roleId) {
                continue;
            }

            DB::table('model_has_roles')->updateOrInsert(
                [
                    'role_id' => $roleId,
                    'model_type' => User::class,
                    'model_id' => $user->id,
                ],
                []
            );
        }
    }
}
