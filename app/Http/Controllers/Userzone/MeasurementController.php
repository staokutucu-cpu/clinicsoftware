<?php

namespace App\Http\Controllers\Userzone;

use App\Http\Controllers\Controller;
use App\Models\Biomarker;
use App\Models\Measurement;
use Illuminate\Http\Request;

class MeasurementController extends Controller
{
    // List of the measurements
    public function index()
    {
        $measurements = Measurement::with('biomarker', 'user')->orderByDesc('measured_at')->get();

        return view('userzone.measurements.index', compact('measurements'));
    }

    // Show an empty form to add a new measurement
    public function create()
    {
        $biomarkers = Biomarker::orderBy('name')->get();

        return view('userzone.measurements.create', compact('biomarkers'));
    }

    // Save the input from the create form
    public function store(Request $request)
    {
        $request->validate([
            'biomarker_id' => ['required', 'exists:biomarkers,id'],
            'value' => ['required', 'numeric', 'min:0'],
            'measured_at' => ['required', 'date', 'before_or_equal:today'],
            'note' => ['nullable', 'string', 'max:500'],
        ]);

        // The new measurement always belongs to the logged in user
        auth()->user()->measurements()->create([
            'biomarker_id' => $request['biomarker_id'],
            'value' => $request['value'],
            'measured_at' => $request['measured_at'],
            'note' => $request['note'],
        ]);

        return redirect()->route('userzone.measurements.index');
    }

    // Details of one measurement
    public function show(Measurement $measurement)
    {
        return view('userzone.measurements.show', compact('measurement'));
    }

    // Show the form to change an existing measurement
    public function edit(Measurement $measurement)
    {
        $biomarkers = Biomarker::orderBy('name')->get();

        return view('userzone.measurements.edit', compact('measurement', 'biomarkers'));
    }

    // Save the input from the edit form
    public function update(Request $request, Measurement $measurement)
    {
        $request->validate([
            'biomarker_id' => ['required', 'exists:biomarkers,id'],
            'value' => ['required', 'numeric', 'min:0'],
            'measured_at' => ['required', 'date', 'before_or_equal:today'],
            'note' => ['nullable', 'string', 'max:500'],
        ]);

        $measurement->update([
            'biomarker_id' => $request['biomarker_id'],
            'value' => $request['value'],
            'measured_at' => $request['measured_at'],
            'note' => $request['note'],
        ]);

        return redirect()->route('userzone.measurements.index');
    }

    // Delete a measurement
    public function destroy(Measurement $measurement)
    {
        $measurement->delete();

        return redirect()->route('userzone.measurements.index');
    }
}
