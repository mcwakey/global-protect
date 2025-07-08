<?php

require_once __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

// Test sections
echo "=== Testing Sections ===\n";
$sections = \App\Models\Section::active()->ordered()->get()->keyBy('key');
echo "Total sections: " . $sections->count() . "\n";
echo "Section keys: " . implode(', ', $sections->keys()->toArray()) . "\n";

foreach ($sections as $key => $section) {
    echo "\nSection '$key':\n";
    echo "  ID: " . $section->id . "\n";
    echo "  Name: " . $section->name . "\n";
    echo "  Type: " . $section->type . "\n";
    echo "  Title: " . $section->title . "\n";
    echo "  Active: " . ($section->is_active ? 'Yes' : 'No') . "\n";
    echo "  Has data: " . (is_array($section->data) ? 'Yes (' . count($section->data) . ' items)' : 'No') . "\n";
}

// Test features and testimonials
echo "\n=== Testing Features ===\n";
$features = \App\Models\Feature::active()->ordered()->get();
echo "Total features: " . $features->count() . "\n";

echo "\n=== Testing Testimonials ===\n";
$testimonials = \App\Models\Testimonial::active()->ordered()->get();
echo "Total testimonials: " . $testimonials->count() . "\n";

echo "\n=== Testing Controller ===\n";
$controller = new \App\Http\Controllers\HomeController();
$result = $controller->index();
echo "View: " . $result->name() . "\n";
$data = $result->getData();
echo "Sections in view data: " . $data['sections']->count() . "\n";
echo "Features in view data: " . $data['features']->count() . "\n";
echo "Testimonials in view data: " . $data['testimonials']->count() . "\n";
