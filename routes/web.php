<?php

use App\Http\Controllers\Dashboard\PageController as DashboardPageController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::prefix('dashboard')->as('dashboard.')->group(function() {
    Route::middleware(['auth'])->group(function () {
        // main dashboard route
        Route::get('/', function () {return view('dashboard');})->name('index');

        Route::get('/pages', [DashboardPageController::class, 'index'])->name('pages');

        Route::get('/pages/edit/{page}', [DashboardPageController::class, 'edit'])->name('pages.edit');
        Route::post('/pages/edit/{page}', [DashboardPageController::class, 'postEdit'])->name('pages.edit');

        Route::get('/pages/edit/{page}/{language}', [DashboardPageController::class, 'editContent'])->name('pages.editContent');
        Route::post('/pages/edit/{page}/{language}', [DashboardPageController::class, 'postEditContent'])->name('pages.editContent');
    });
});

// random pages in our website
Route::get('/{locale?}', [PageController::class, 'view'])->name('pages.home');
Route::get('/{locale}/{page}', [PageController::class, 'view'])->name('pages.page');


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
