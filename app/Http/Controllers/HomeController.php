<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Section;
use App\Models\Feature;
use App\Models\Testimonial;
use App\Models\Setting;

class HomeController extends Controller
{
    public function index()
    {
        $sections = Section::active()->ordered()->get()->keyBy('key');
        $features = Feature::active()->ordered()->get();
        $testimonials = Testimonial::active()->ordered()->get();

        // Load settings for contact info, company info, and emergency contact
        $settings = [
            'contact_email' => Setting::get('contact_email'),
            'contact_phone' => Setting::get('contact_phone'),
            'contact_address' => Setting::get('contact_address'),
            'contact_hours' => Setting::get('contact_hours'),
            'company_name' => Setting::get('company_name'),
            'emergency_number' => Setting::get('emergency_number'),
            'emergency_hotline' => Setting::get('emergency_hotline'),
        ];

        return view('home', compact('sections', 'features', 'testimonials', 'settings'));
    }
}
