<?php

namespace App\Http\Controllers;

use App\Models\Biomarker;

class BiomarkerController extends Controller
{
    // List of all biomarkers
    public function index()
    {
        $biomarkers = Biomarker::orderBy('name')->get();

        return view('biomarkers.index', compact('biomarkers'));
    }

    // Details of one biomarker
    public function show(Biomarker $biomarker)
    {
        return view('biomarkers.show', compact('biomarker'));
    }
}
