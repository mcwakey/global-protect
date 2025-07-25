<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create default admin user
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@globaleprotect.com',
        ]);

        // Seed content data
        $this->call([
            SectionSeeder::class,
            FeatureSeeder::class,
            TestimonialSeeder::class,
            LegalPageSeeder::class,
        ]);
    }
}
