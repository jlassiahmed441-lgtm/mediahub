<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ContenuController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;


Route::get('/', [PageController::class, 'accueil'])->name('accueil');


Route::resource('contenus', ContenuController::class)
    ->where(['contenu' => '[0-9]+']);

 Route::get('/contenus/tri/{tri?}', [ContenuController::class, 'index'])
    ->name('contenus.tri');


Route::get('/contenus/tri/{tri?}', [ContenuController::class, 'index'])
    ->name('contenus.tri');


Route::get('/a-propos', [PageController::class, 'aPropos'])
    ->name('a-propos');


Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/tableau-de-bord', [AdminController::class, 'index'])
        ->name('dashboard');
});
Route::get('/categories', [CategoryController::class, 'index'])
    ->name('categories.index');
   