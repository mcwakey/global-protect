<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Section;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sections = [
            [
                'key' => 'hero',
                'title' => 'Digital Solutions for Emergency & Rescue Services',
                'content' => 'Globale Protect provides cutting-edge digital solutions designed to enhance emergency response capabilities and save lives through innovative technology.',
                'data' => [
                    'subtitle' => 'Protecting Lives Through Innovation',
                    'cta_text' => 'Learn More',
                    'cta_link' => '#about',
                    'background_image' => '/images/hero-bg.jpg'
                ],
                'is_active' => true,
                'sort_order' => 1
            ],
            [
                'key' => 'about',
                'title' => 'About Globale Protect',
                'content' => 'We are a leading provider of digital solutions for emergency and rescue services. Our mission is to leverage technology to improve response times, enhance communication, and ultimately save more lives during critical situations.',
                'data' => [
                    'mission' => 'To revolutionize emergency response through innovative digital solutions',
                    'vision' => 'A world where technology ensures faster, more efficient emergency services',
                    'values' => ['Innovation', 'Reliability', 'Life-saving', 'Excellence']
                ],
                'is_active' => true,
                'sort_order' => 2
            ],
            [
                'key' => 'contact',
                'title' => 'Get in Touch',
                'content' => 'Ready to learn more about our digital solutions? Contact us today to discuss how we can help improve your emergency response capabilities.',
                'data' => [
                    'phone' => '+1 (555) 123-4567',
                    'email' => 'info@globaleprotect.com',
                    'address' => '123 Emergency Lane, Safety City, SC 12345',
                    'hours' => '24/7 Emergency Support Available'
                ],
                'is_active' => true,
                'sort_order' => 4
            ]
        ];

        foreach ($sections as $section) {
            Section::create($section);
        }
    }
}
