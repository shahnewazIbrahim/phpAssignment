<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AboutSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('about_settings')->updateOrInsert(
            ['id' => 1],
            [
                'banner' => 'about-banner-demo.jpg',
                'company_history' => 'JobPulse started as a lightweight hiring platform focused on connecting local companies with skilled candidates across Bangladesh.',
                'our_vision' => 'Build a fast and transparent recruitment experience where employers publish jobs easily and candidates apply with complete profiles.',
                'updated_at' => now(),
                'created_at' => now(),
            ]
        );
    }
}
