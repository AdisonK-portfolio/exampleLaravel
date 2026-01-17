<?php

use Inertia\Inertia;
use Laravel\Fortify\Features;
use Illuminate\Support\Facades\Route;
use App\Http\Resources\ContactResource;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ContactController;

Route::get('/', [ContactController::class, 'index']
//function () {
    // return Inertia::render('Welcome', [
    //     'canRegister' => Features::enabled(Features::registration()),
    // ]);
//}
)->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/settings.php';

Route::get('/contacts/export', [ContactController::class, 'export']);
Route::resource('contacts', ContactController::class);

Route::get('/companies/export', [CompanyController::class, 'export']);
Route::resource('companies', CompanyController::class);

Route::get('/users/export', [UserController::class, 'export']);
Route::resource('users', UserController::class);





// APIs

Route::get('/api/contacts', [ContactController::class, 'apiList']);
