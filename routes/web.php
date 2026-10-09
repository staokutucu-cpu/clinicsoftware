<?php

use App\Http\Controllers\BiomarkerController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', [WelcomeController::class, 'index'])->name('home');

Route::get('biomarkers', [BiomarkerController::class, 'index'])->name('biomarkers.index');
Route::get('biomarkers/{biomarker}', [BiomarkerController::class, 'show'])->name('biomarkers.show');

Route::get('/dashboard', function () {
    return view('userzone.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // CRUD for measurements
    Route::get('userzone/measurements', [App\Http\Controllers\Userzone\MeasurementController::class, 'index'])->name('userzone.measurements.index');
    Route::get('userzone/measurements/create', [App\Http\Controllers\Userzone\MeasurementController::class, 'create'])->name('userzone.measurements.create');
    Route::post('userzone/measurements', [App\Http\Controllers\Userzone\MeasurementController::class, 'store'])->name('userzone.measurements.store');
    Route::get('userzone/measurements/{measurement}', [App\Http\Controllers\Userzone\MeasurementController::class, 'show'])->name('userzone.measurements.show');
    Route::get('userzone/measurements/{measurement}/edit', [App\Http\Controllers\Userzone\MeasurementController::class, 'edit'])->name('userzone.measurements.edit');
    Route::put('userzone/measurements/{measurement}', [App\Http\Controllers\Userzone\MeasurementController::class, 'update'])->name('userzone.measurements.update');
    Route::delete('userzone/measurements/{measurement}', [App\Http\Controllers\Userzone\MeasurementController::class, 'destroy'])->name('userzone.measurements.destroy');

    Route::get('/profile', [App\Http\Controllers\Userzone\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [App\Http\Controllers\Userzone\ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [App\Http\Controllers\Userzone\ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
