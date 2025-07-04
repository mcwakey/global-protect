<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ManualController extends Controller
{
    /**
     * Display the user manual.
     */
    public function index()
    {
        return view('admin.manual.index');
    }
}
