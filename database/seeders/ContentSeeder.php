<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\WebsiteSection;
use App\Models\WebsiteSetting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ContentSeeder extends Seeder
{
    public function run(): void
    {
        $defaults = config('website.defaults');

        foreach ($defaults as $key => $value) {
            WebsiteSetting::updateOrCreate(['key' => $key], ['value' => (string) $value]);
        }

        foreach (config('website.sections') as $key => $section) {
            WebsiteSection::updateOrCreate(
                ['key' => $key],
                [
                    'eyebrow' => $section['eyebrow'] ?? null,
                    'heading' => $section['heading'] ?? null,
                    'sub_heading' => $section['sub_heading'] ?? null,
                    'content' => $section['content'] ?? null,
                    'image' => $section['image'] ?? null,
                    'is_active' => true,
                ]
            );
        }

        User::updateOrCreate(
            ['email' => 'admin@induheat.com'],
            [
                'name' => 'Site Administrator',
                'password' => Hash::make('Admin@12345'),
                'phone' => '+92 300 123 4567',
                'is_admin' => true,
                'email_verified_at' => now(),
            ]
        );
    }
}
