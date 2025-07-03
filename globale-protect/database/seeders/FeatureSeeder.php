<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Feature;

class FeatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $features = [
            [
                'title' => 'Qwick Rescue',
                'description' => 'Our flagship emergency response platform that enables rapid deployment of rescue teams with real-time location tracking and communication capabilities.',
                'icon' => 'fas fa-ambulance',
                'link' => '#qwick-rescue',
                'is_active' => true,
                'sort_order' => 1
            ],
            [
                'title' => 'QR Medical Info',
                'description' => 'Instant access to critical medical information through QR codes. Emergency responders can quickly access patient data, allergies, medications, and emergency contacts.',
                'icon' => 'fas fa-qrcode',
                'link' => '#qr-medical',
                'is_active' => true,
                'sort_order' => 2
            ],
            [
                'title' => 'Emergency Communication Hub',
                'description' => 'Unified communication platform that connects all emergency services, hospitals, and first responders in real-time for coordinated response efforts.',
                'icon' => 'fas fa-broadcast-tower',
                'link' => '#communication',
                'is_active' => true,
                'sort_order' => 3
            ],
            [
                'title' => 'AI-Powered Dispatch',
                'description' => 'Advanced AI algorithms that analyze emergency calls, predict resource needs, and optimize dispatch routing for faster response times.',
                'icon' => 'fas fa-robot',
                'link' => '#ai-dispatch',
                'is_active' => true,
                'sort_order' => 4
            ],
            [
                'title' => 'Mobile Command Center',
                'description' => 'Portable digital command center that can be deployed anywhere to coordinate large-scale emergency operations with full communication capabilities.',
                'icon' => 'fas fa-mobile-alt',
                'link' => '#mobile-command',
                'is_active' => true,
                'sort_order' => 5
            ],
            [
                'title' => 'Data Analytics Dashboard',
                'description' => 'Comprehensive analytics platform that provides insights into emergency patterns, response times, and resource utilization for continuous improvement.',
                'icon' => 'fas fa-chart-bar',
                'link' => '#analytics',
                'is_active' => true,
                'sort_order' => 6
            ]
        ];

        foreach ($features as $feature) {
            Feature::create($feature);
        }
    }
}
