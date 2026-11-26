<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ContenuController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AuthController;

Route::get('/', [PageController::class, 'accueil'])->name('accueil');


// Consultation publique des publications
Route::get('/contenus', [ContenuController::class, 'index'])
    ->name('contenus.index');

Route::get('/contenus/{contenu}', [ContenuController::class, 'show'])
    ->whereNumber('contenu')
    ->name('contenus.show');

// Actions réservées aux utilisateurs connectés
Route::middleware('auth')->group(function () {

    Route::get('/contenus/create', [ContenuController::class, 'create'])
        ->name('contenus.create');

    Route::post('/contenus', [ContenuController::class, 'store'])
        ->name('contenus.store');

    Route::get('/contenus/{contenu}/edit', [ContenuController::class, 'edit'])
        ->whereNumber('contenu')
        ->name('contenus.edit');

    Route::put('/contenus/{contenu}', [ContenuController::class, 'update'])
        ->whereNumber('contenu')
        ->name('contenus.update');

    Route::delete('/contenus/{contenu}', [ContenuController::class, 'destroy'])
        ->whereNumber('contenu')
        ->name('contenus.destroy');
});

 Route::get('/contenus/tri/{tri?}', [ContenuController::class, 'index'])
    ->name('contenus.tri');





Route::get('/a-propos', [PageController::class, 'aPropos'])
    ->name('a-propos');


Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/tableau-de-bord', [AdminController::class, 'index'])
        ->name('dashboard');
});
Route::resource('categories', CategoryController::class);

Route::middleware('guest')->group(function () {

    // Inscription
    Route::get('/inscription', [AuthController::class, 'inscription'])
        ->name('inscription');

    Route::post('/inscription', [AuthController::class, 'store'])
        ->name('inscription.store');

    // Connexion
    Route::get('/connexion', [AuthController::class, 'creerConnexion'])
        ->name('connexion');

    Route::post('/connexion', [AuthController::class, 'connecter'])
        ->name('connexion.authenticate');
});


Route::post('/deconnexion', [AuthController::class, 'deconnecter'])
    ->middleware('auth')
    ->name('deconnexion');
   