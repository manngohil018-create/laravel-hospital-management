<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DoctorController;
use App\Http\Controllers\Admin\PatientController;
use App\Http\Controllers\Admin\AnalyticsController;
use App\Http\Controllers\Admin\ExportController;
use App\Http\Controllers\Admin\CalendarController;
use App\Http\Controllers\Doctor\DoctorDashboardController;
use App\Http\Controllers\Doctor\DoctorAnalyticsController;
use App\Http\Controllers\Admin\AppointmentController as AdminAppointmentController;


// Home Route
Route::get('/', function () {
    $doctors = \App\Models\Doctor::all();
    return view('home', compact('doctors'));
})->name('home');

// About Route
Route::get('/about', function () {
    return view('about');
})->name('about');

// Doctors Route
Route::get('/doctors', function () {
    $doctors = \App\Models\Doctor::all();
    return view('doctors', compact('doctors'));
})->name('doctors');

// Doctor Profile/Dashboard (simple doctor-specific dashboard)
Route::get('/doctor/profile', [\App\Http\Controllers\DoctorController::class, 'dashboard'])
    ->middleware(['auth','role:doctor'])
    ->name('doctor.profile');
// Services Route
Route::get('/services', function () {
    return view('services');
})->name('services');

// Contact Route
Route::get('/contact', function () {
    return view('contact');
})->name('contact');

// Book Appointment Route
Route::get('/book-appointment/{doctor?}', [AppointmentController::class, 'create'])
    ->name('book-appointment');

Route::get('/appointment/available-slots', [AppointmentController::class, 'availableSlots'])
    ->name('appointment.available-slots');

/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/register', function () {
    return view('register');
})->name('register');

Route::post('/register', [AuthController::class, 'register'])
    ->name('register.store');

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login.store');

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');

Route::get('/dashboard', [AuthController::class, 'dashboard'])
    ->middleware('auth')
    ->name('dashboard');


/*
|--------------------------------------------------------------------------
| PATIENT ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:patient'])->group(function(){

    Route::get('/appointment/create',
        [AppointmentController::class,'create'])
        ->name('appointment.create');

    Route::post('/appointment/store',
        [AppointmentController::class,'store'])
        ->name('appointment.store');

    Route::get('/my-appointments',
        [AppointmentController::class,'myAppointments'])
        ->name('my-appointments');

});


/*
|--------------------------------------------------------------------------
| DOCTOR ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:doctor'])
    ->prefix('doctor')
    ->name('doctor.')
    ->group(function(){

    Route::get('/dashboard',
        [DoctorDashboardController::class,'index'])
        ->name('dashboard');

    Route::get('/analytics',
        [DoctorAnalyticsController::class,'index'])
        ->name('analytics');

    Route::post('/appointment/{id}/status',
        [DoctorDashboardController::class,'updateAppointmentStatus'])
        ->name('appointment.update-status');

    Route::get('/appointments',
        [AppointmentController::class,'doctorAppointments'])
        ->name('appointments');

});


/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware(['auth','role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function(){

    // Admin Dashboard
    Route::get('/dashboard',
        [DashboardController::class,'index'])
        ->name('dashboard');

    // Doctors CRUD
    Route::resource('/doctors', DoctorController::class);

    // Appointments Manage
    Route::resource('/appointments', AdminAppointmentController::class);

    // Patients List
    Route::get('/patients',
        [PatientController::class,'index'])
        ->name('patients');

    Route::get('/patients/{patient}',
        [PatientController::class,'show'])
        ->name('patients.show');

    Route::get('/patients/{patient}/edit',
        [PatientController::class,'edit'])
        ->name('patients.edit');

    Route::put('/patients/{patient}',
        [PatientController::class,'update'])
        ->name('patients.update');

    Route::delete('/patients/{patient}',
        [PatientController::class,'destroy'])
        ->name('patients.destroy');

    // Analytics Dashboard
    Route::get('/analytics',
        [AnalyticsController::class,'index'])
        ->name('analytics');

    // Calendar View
    Route::get('/calendar',
        [CalendarController::class,'index'])
        ->name('calendar');

    Route::get('/calendar/events',
        [CalendarController::class,'getEvents'])
        ->name('calendar.events');

    // Export Routes
    Route::get('/export/appointments',
        [ExportController::class,'exportAppointments'])
        ->name('export.appointments');

    Route::get('/export/doctors',
        [ExportController::class,'exportDoctors'])
        ->name('export.doctors');

    Route::get('/export/patients',
        [ExportController::class,'exportPatients'])
        ->name('export.patients');

});
