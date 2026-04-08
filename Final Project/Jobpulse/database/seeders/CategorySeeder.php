<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
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

        $categories = [
            'Software Engineering',
            'UI/UX Design',
            'Digital Marketing',
            'Human Resources',
            'Accounts & Finance',
            'Customer Support',
        ];

        foreach ($categories as $name) {
            DB::table('categories')->updateOrInsert(
                ['name' => $name],
                [
                    'user_id' => $owner->id,
                    'updated_at' => now(),
                    'created_at' => now(),
                ]
            );
        }
    }
}
