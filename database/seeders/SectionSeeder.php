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
                'name' => 'Hero Section',
                'type' => 'hero',
                'title' => 'Digital Solutions for Emergency & Rescue Services',
                'content' => 'Globale Protect provides cutting-edge digital solutions designed to enhance emergency response capabilities and save lives through innovative technology.',
                'data' => [
                    'slides' => [
                        [
                            'title' => 'Digital Solutions for Emergency & Rescue Services',
                            'subtitle' => 'Protecting Lives Through Innovation',
                            'content' => 'Globale Protect provides cutting-edge digital solutions designed to enhance emergency response capabilities and save lives through innovative technology.',
                            'cta_text' => 'Learn More',
                            'cta_link' => '#about',
                            'image' => ''
                        ],
                        [
                            'title' => 'Emergency Response Excellence',
                            'subtitle' => 'Rapid Response Technology',
                            'content' => 'Advanced emergency management systems that reduce response times and coordinate rescue operations seamlessly.',
                            'cta_text' => 'Our Solutions',
                            'cta_link' => '#services',
                            'image' => ''
                        ],
                        [
                            'title' => 'Cutting-Edge Technology',
                            'subtitle' => 'AI-Powered Solutions',
                            'content' => 'AI-powered dispatch systems, real-time communication platforms, and advanced analytics for optimal emergency management.',
                            'cta_text' => 'View Features',
                            'cta_link' => '#services',
                            'image' => ''
                        ]
                    ],
                    'settings' => [
                        'autoplay' => true,
                        'autoplay_interval' => 5
                    ]
                ],
                'is_active' => true,
                'sort_order' => 1
            ],
            [
                'key' => 'about',
                'name' => 'About Section',
                'type' => 'about',
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
                'key' => 'services',
                'name' => 'Services Section',
                'type' => 'services',
                'title' => 'Our Digital Solutions',
                'content' => 'Comprehensive emergency response technologies designed to save lives and improve emergency service efficiency.',
                'data' => [
                    'subtitle' => 'Innovative tools for modern emergency response teams'
                ],
                'is_active' => true,
                'sort_order' => 3
            ],
            [
                'key' => 'contact',
                'name' => 'Contact Section',
                'type' => 'contact',
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
            Section::updateOrCreate(
                ['key' => $section['key']],
                $section
            );
        }
    }
}
