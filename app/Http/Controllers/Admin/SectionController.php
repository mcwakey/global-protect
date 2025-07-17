<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sections = Section::orderBy('sort_order')->paginate(10);
        return view('admin.sections.index', compact('sections'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.sections.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255|unique:sections,type',
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'sort_order' => 'integer|min:0',
            'is_active' => 'boolean',
            'image' => 'nullable|image|max:2048',
        ], [
            'type.unique' => 'A section with this type already exists. Each section type can only be created once.',
        ]);

        $data = $request->all();
        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('sections', 'public');
        }

        // Handle hero slider data
        if ($request->type === 'hero' && $request->has('slides')) {
            $slides = [];
            foreach ($request->slides as $index => $slide) {
                $slideData = [
                    'title' => $slide['title'] ?? '',
                    'subtitle' => $slide['subtitle'] ?? '',
                    'content' => $slide['content'] ?? '',
                    'cta_text' => $slide['cta_text'] ?? '',
                    'cta_link' => $slide['cta_link'] ?? '',
                    'image' => $slide['existing_image'] ?? ''
                ];

                // Handle slide image upload
                if ($request->hasFile("slides.{$index}.image")) {
                    $slideData['image'] = $request->file("slides.{$index}.image")->store('hero-slides', 'public');
                }

                $slides[] = $slideData;
            }

            $settings = [
                'autoplay' => $request->has('settings.autoplay'),
                'autoplay_interval' => $request->input('settings.autoplay_interval', 5)
            ];

            $data['data'] = [
                'slides' => $slides,
                'settings' => $settings
            ];
        }

        Section::create($data);

        return redirect()->route('admin.sections.index')
            ->with('success', 'Section created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Section $section)
    {
        return view('admin.sections.show', compact('section'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Section $section)
    {
        return view('admin.sections.edit', compact('section'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Section $section)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255|unique:sections,type,' . $section->id,
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'sort_order' => 'integer|min:0',
            'is_active' => 'boolean',
            'image' => 'nullable|image|max:2048',
        ], [
            'type.unique' => 'A section with this type already exists. Each section type can only be created once.',
        ]);

        $data = $request->all();
        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            if ($section->image) {
                Storage::disk('public')->delete($section->image);
            }
            $data['image'] = $request->file('image')->store('sections', 'public');
        }

        // Handle hero slider data
        if ($request->type === 'hero' && $request->has('slides')) {
            $slides = [];
            foreach ($request->slides as $index => $slide) {
                $slideData = [
                    'title' => $slide['title'] ?? '',
                    'subtitle' => $slide['subtitle'] ?? '',
                    'content' => $slide['content'] ?? '',
                    'cta_text' => $slide['cta_text'] ?? '',
                    'cta_link' => $slide['cta_link'] ?? '',
                    'image' => $slide['existing_image'] ?? ''
                ];

                // Handle slide image upload
                if ($request->hasFile("slides.{$index}.image")) {
                    // Delete old slide image if exists
                    if (!empty($slide['existing_image'])) {
                        Storage::disk('public')->delete($slide['existing_image']);
                    }
                    $slideData['image'] = $request->file("slides.{$index}.image")->store('hero-slides', 'public');
                }

                $slides[] = $slideData;
            }

            $settings = [
                'autoplay' => $request->has('settings.autoplay'),
                'autoplay_interval' => $request->input('settings.autoplay_interval', 5)
            ];

            $data['data'] = [
                'slides' => $slides,
                'settings' => $settings
            ];
        }

        $section->update($data);

        return redirect()->route('admin.sections.index')
            ->with('success', 'Section updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Section $section)
    {
        if ($section->image) {
            Storage::disk('public')->delete($section->image);
        }

        $section->delete();

        return redirect()->route('admin.sections.index')
            ->with('success', 'Section deleted successfully.');
    }
}
