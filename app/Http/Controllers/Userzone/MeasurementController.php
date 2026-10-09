<?php

namespace App\Http\Controllers\Userzone;

use App\Http\Controllers\Controller;
use App\Models\Measurement;

class MeasurementController extends Controller
{
    // List of the measurements
    public function index()
    {
        $measurements = Measurement::with('biomarker', 'user')->orderByDesc('measured_at')->get();

        return view('userzone.measurements.index', compact('measurements'));
    }
}
