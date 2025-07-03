<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            [
                'key' => 'site_name',
                'value' => 'Globale Protect',
                'type' => 'text',
                'description' => 'Site Name',
                'is_public' => true,
            ],
            [
                'key' => 'site_description',
                'value' => 'Digital Solutions for Emergency & Rescue Services',
                'type' => 'text',
                'description' => 'Site Description',
                'is_public' => true,
            ],
            [
                'key' => 'contact_email',
                'value' => 'contact@globaleprotect.com',
                'type' => 'text',
                'description' => 'Contact Email',
                'is_public' => true,
            ],
            [
                'key' => 'contact_phone',
                'value' => '+1 (555) 123-4567',
                'type' => 'text',
                'description' => 'Contact Phone',
                'is_public' => true,
            ],
            [
                'key' => 'contact_address',
                'value' => '123 Emergency Services Blvd, Emergency City, EC 12345',
                'type' => 'text',
                'description' => 'Contact Address',
                'is_public' => true,
            ],
            [
                'key' => 'emergency_number',
                'value' => '911',
                'type' => 'text',
                'description' => 'Emergency Number',
                'is_public' => true,
            ],
            [
                'key' => 'maintenance_mode',
                'value' => '0',
                'type' => 'boolean',
                'description' => 'Maintenance Mode',
                'is_public' => false,
            ],
            [
                'key' => 'enable_registrations',
                'value' => '1',
                'type' => 'boolean',
                'description' => 'Enable User Registrations',
                'is_public' => false,
            ],
            [
                'key' => 'primary_color',
                'value' => '#2563eb',
                'type' => 'text',
                'description' => 'Primary Color',
                'is_public' => true,
            ],
            [
                'key' => 'secondary_color',
                'value' => '#1e40af',
                'type' => 'text',
                'description' => 'Secondary Color',
                'is_public' => true,
            ],
            [
                'key' => 'accent_color',
                'value' => '#3b82f6',
                'type' => 'text',
                'description' => 'Accent Color',
                'is_public' => true,
            ],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }
}
