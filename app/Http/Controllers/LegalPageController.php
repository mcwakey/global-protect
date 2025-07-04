<?php

namespace App\Http\Controllers;

use App\Models\LegalPage;
use Illuminate\Http\Request;

class LegalPageController extends Controller
{
    /**
     * Show a legal page by type
     */
    public function show($type)
    {
        $legalPage = LegalPage::getByType($type);

        if (!$legalPage) {
            abort(404);
        }

        return view('legal.show', compact('legalPage'));
    }
}
