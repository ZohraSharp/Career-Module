<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\jobApplicationController;

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Redirect;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::resource('/', jobApplicationController::class);
Route::post('/career', [jobApplicationController::class, 'store'])->name('career.store');
Route::get('career-form', [jobApplicationController::class, 'create'])->name('career-form.create');

// In routes/web.php
Route::get('/applicantData', [JobApplicationController::class, 'index'])->name('applicantData.index');
Route::get('/applicantData/data', [JobApplicationController::class, 'show'])->name('applicantData.show');
Route::prefix('hr')->group(function () {
Route::get('/job-seekers/download/{jobSeekerId}', [jobApplicationController::class, 'downloadResume'])->name('hr.download');
Route::get('/job-seekers/view/{jobSeekerId}', [jobApplicationController::class, 'viewProfile'])->name('hr.view');

});


