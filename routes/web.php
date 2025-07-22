<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StepOneController;
use App\Http\Controllers\Step2Controller;

// Main Entry
Route::get('/', [StepOneController::class, 'index'])->name('step1');
Route::get('/step1', [StepOneController::class, 'index'])->name('step1');

// Navigation to Next Step
Route::post('/step1/next', [StepOneController::class, 'next'])->name('step1.next');

// Step 1 - Shift Type CRUD
Route::post('/shift-type', [StepOneController::class, 'storeShiftType'])->name('shift-type.store');
Route::get('/shift-types/{id}/edit', [StepOneController::class, 'editShiftType'])->name('shift-types.edit');
Route::put('/shift-types/{id}', [StepOneController::class, 'updateShiftType'])->name('shift-types.update');
Route::delete('/shift-types/{id}', [StepOneController::class, 'deleteShiftType'])->name('shift-types.delete');

// Step 1 - Location CRUD
Route::post('/location', [StepOneController::class, 'storeLocation'])->name('location.store');
Route::get('/locations/{id}/edit', [StepOneController::class, 'editLocation'])->name('locations.edit');
Route::put('/locations/{id}', [StepOneController::class, 'updateLocation'])->name('locations.update');
Route::delete('/locations/{id}', [StepOneController::class, 'deleteLocation'])->name('locations.delete');

// Step 2 Page
Route::get('/step2', [Step2Controller::class, 'index'])->name('step2');

// Step 2 - Deletion for Shift Types and Locations (separate from Step 1)
Route::delete('/step2/shift-types/{id}', [Step2Controller::class, 'destroyShiftType'])->name('step2.shift-types.destroy');
Route::delete('/step2/locations/{id}', [Step2Controller::class, 'destroyLocation'])->name('step2.locations.destroy');

?>