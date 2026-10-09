<?php

namespace App\Http\Controllers;

use App\Models\Biomarker;

class WelcomeController extends Controller
{
    public function index()
    {
        // Get the number of biomarkers to show on the homepage
        $biomarkerCount = Biomarker::count();

        return view('welcome', compact('biomarkerCount'));
    }
}
