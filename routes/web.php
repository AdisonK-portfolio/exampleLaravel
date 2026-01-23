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

// By splitting up the routes (instead of Route::resources()) I can name the routes
Route::get('/contacts', [ContactController::class, 'index'])->name('contacts');
Route::get('/contacts/export', [ContactController::class, 'export'])->name('contacts.export');
Route::get('/contact/create', [ContactController::class, 'create'])->name('contact.create');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::get('/contact/{contact}/edit', [ContactController::class, 'edit'])->name('contact.edit');
Route::patch('/contact/{contact}', [ContactController::class, 'update'])->name('contact.update');

//Route::resource('contacts', ContactController::class);

Route::get('/companies/export', [CompanyController::class, 'export']);
Route::resource('companies', CompanyController::class);

Route::get('/users/export', [UserController::class, 'export']);
Route::resource('users', UserController::class);


// APIs

Route::get('/api/contacts', [ContactController::class, 'apiList']);
