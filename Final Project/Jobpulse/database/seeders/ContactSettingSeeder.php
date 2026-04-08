<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContactSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('contact_settings')->updateOrInsert(
            ['id' => 1],
            [
                'banner' => 'contact-banner-demo.jpg',
                'contact_us' => 'Email: support@jobpulse.test, Phone: +8801700000010, Address: Banani, Dhaka, Bangladesh.',
                'updated_at' => now(),
                'created_at' => now(),
            ]
        );
    }
}
