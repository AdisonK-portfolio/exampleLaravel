<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Features;
use App\Http\Controllers\ContactController;
use App\Http\Resources\ContactResource;

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





// APIs

//Route::get('/api/contacts', [ContactController::class, 'apiList']);
