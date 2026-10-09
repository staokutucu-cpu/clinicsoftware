<?php

namespace App\Http\Controllers\Userzone;

use App\Http\Controllers\Controller;
use App\Models\Biomarker;
use App\Models\Measurement;
use App\Models\User;
use Illuminate\Http\Request;

class MeasurementController extends Controller
{
    // List of the measurements
    public function index()
    {
        // A doctor sees the measurements of all patients, a patient only sees their own
        if (auth()->user()->is_doctor) {
            $measurements = Measurement::with('biomarker', 'user')->orderByDesc('measured_at')->get();
        } else {
            $measurements = auth()->user()->measurements()->with('biomarker', 'user')->orderByDesc('measured_at')->get();
        }

        return view('userzone.measurements.index', compact('measurements'));
    }

    // Show an empty form to add a new measurement
    public function create()
    {
        // Only a doctor can enter measurements
        if (! auth()->user()->is_doctor) {
            abort(403);
        }

        $biomarkers = Biomarker::orderBy('name')->get();
        $patients = User::where('is_doctor', false)->orderBy('name')->get();

        return view('userzone.measurements.create', compact('biomarkers', 'patients'));
    }

    // Save the input from the create form
    public function store(Request $request)
    {
        // Only a doctor can enter measurements
        if (! auth()->user()->is_doctor) {
            abort(403);
        }

        $request->validate([
            'user_id' => ['required', 'exists:users,id'],
            'biomarker_id' => ['required', 'exists:biomarkers,id'],
            'value' => ['required', 'numeric', 'min:0'],
            'measured_at' => ['required', 'date', 'before_or_equal:today'],
            'note' => ['nullable', 'string', 'max:500'],
        ]);

        // The doctor enters the measurement for the chosen patient
        Measurement::create([
            'user_id' => $request['user_id'],
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
        if (! $measurement->canView(auth()->user())) {
            abort(403);
        }

        return view('userzone.measurements.show', compact('measurement'));
    }

    // Show the form to change an existing measurement
    public function edit(Measurement $measurement)
    {
        if (! $measurement->canChange(auth()->user())) {
            abort(403);
        }

        $biomarkers = Biomarker::orderBy('name')->get();
        $patients = User::where('is_doctor', false)->orderBy('name')->get();

        return view('userzone.measurements.edit', compact('measurement', 'biomarkers', 'patients'));
    }

    // Save the input from the edit form
    public function update(Request $request, Measurement $measurement)
    {
        if (! $measurement->canChange(auth()->user())) {
            abort(403);
        }

        $request->validate([
            'user_id' => ['required', 'exists:users,id'],
            'biomarker_id' => ['required', 'exists:biomarkers,id'],
            'value' => ['required', 'numeric', 'min:0'],
            'measured_at' => ['required', 'date', 'before_or_equal:today'],
            'note' => ['nullable', 'string', 'max:500'],
        ]);

        $measurement->update([
            'user_id' => $request['user_id'],
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
        if (! $measurement->canChange(auth()->user())) {
            abort(403);
        }

        $measurement->delete();

        return redirect()->route('userzone.measurements.index');
    }
}
