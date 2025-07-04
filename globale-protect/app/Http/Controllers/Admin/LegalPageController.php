<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LegalPage;
use Illuminate\Http\Request;

class LegalPageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $legalPages = LegalPage::all();
        return view('admin.legal-pages.index', compact('legalPages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.legal-pages.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|string|unique:legal_pages,type',
            'title_en' => 'required|string|max:255',
            'title_fr' => 'required|string|max:255',
            'content_en' => 'required|string',
            'content_fr' => 'required|string',
            'is_active' => 'boolean',
        ]);

        LegalPage::create([
            'type' => $request->type,
            'title' => [
                'en' => $request->title_en,
                'fr' => $request->title_fr,
            ],
            'content' => [
                'en' => $request->content_en,
                'fr' => $request->content_fr,
            ],
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.legal-pages.index')
            ->with('success', __('messages.legal_page_created_successfully'));
    }

    /**
     * Display the specified resource.
     */
    public function show(LegalPage $legalPage)
    {
        return view('admin.legal-pages.show', compact('legalPage'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LegalPage $legalPage)
    {
        return view('admin.legal-pages.edit', compact('legalPage'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LegalPage $legalPage)
    {
        $request->validate([
            'type' => 'required|string|unique:legal_pages,type,' . $legalPage->id,
            'title_en' => 'required|string|max:255',
            'title_fr' => 'required|string|max:255',
            'content_en' => 'required|string',
            'content_fr' => 'required|string',
            'is_active' => 'boolean',
        ]);

        $legalPage->update([
            'type' => $request->type,
            'title' => [
                'en' => $request->title_en,
                'fr' => $request->title_fr,
            ],
            'content' => [
                'en' => $request->content_en,
                'fr' => $request->content_fr,
            ],
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.legal-pages.index')
            ->with('success', __('messages.legal_page_updated_successfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LegalPage $legalPage)
    {
        $legalPage->delete();

        return redirect()->route('admin.legal-pages.index')
            ->with('success', __('messages.legal_page_deleted_successfully'));
    }
}
