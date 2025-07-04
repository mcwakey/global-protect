<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Section;
use App\Models\Feature;
use App\Models\Testimonial;

class HomeController extends Controller
{
    public function index()
    {
        $sections = Section::active()->ordered()->get()->keyBy('key');
        $features = Feature::active()->ordered()->get();
        $testimonials = Testimonial::active()->ordered()->get();

        return view('home', compact('sections', 'features', 'testimonials'));
    }
}
