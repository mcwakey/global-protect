<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Testimonial;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $testimonials = [
            [
                'name' => 'Dr. Sarah Johnson',
                'position' => 'Emergency Department Director',
                'company' => 'City General Hospital',
                'content' => 'Globale Protect\'s QR Medical Info system has revolutionized how we access patient information during emergencies. The time saved has literally been life-saving in critical situations.',
                'rating' => 5,
                'is_active' => true,
                'sort_order' => 1
            ],
            [
                'name' => 'Chief Mike Rodriguez',
                'position' => 'Fire Chief',
                'company' => 'Metro Fire Department',
                'content' => 'The Qwick Rescue platform has improved our response times by 40%. The real-time coordination and communication features are outstanding.',
                'rating' => 5,
                'is_active' => true,
                'sort_order' => 2
            ],
            [
                'name' => 'Captain Lisa Chen',
                'position' => 'EMS Supervisor',
                'company' => 'Regional Emergency Services',
                'content' => 'The AI-powered dispatch system has transformed our operations. We can now predict and prepare for emergency situations before they escalate.',
                'rating' => 5,
                'is_active' => true,
                'sort_order' => 3
            ],
            [
                'name' => 'Director James Wilson',
                'position' => 'Emergency Management Director',
                'company' => 'State Emergency Management Agency',
                'content' => 'The mobile command center has been invaluable during natural disasters. It provides seamless coordination capabilities in the most challenging environments.',
                'rating' => 5,
                'is_active' => true,
                'sort_order' => 4
            ]
        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::create($testimonial);
        }
    }
}
