<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('/login');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/dashboard', [PersonaController::class, 'index'])->name('dashboard');
    Route::post('/personas', [PersonaController::class, 'obtenerPersona'])->name('personas.obtenerPersona');

    Route::middleware('admin')->group(function () {
        Route::get('/superadmin', [AdminController::class, 'index'])->name('admin.index');
        Route::get('/superadmin/getAllUsers', [AdminController::class, 'getAllUsers'])->name('admin.getAllUsers');
        Route::post('/superadmin/createUser', [AdminController::class, 'store'])->name('admin.createUser');
        Route::get('/superadmin/showUser/{user}', [AdminController::class, 'show'])->name('admin.showUser');
        Route::post('/superadmin/updateUser', [AdminController::class, 'update'])->name('admin.updateUser');
        Route::post('/superadmin/destroyUser', [AdminController::class, 'destroy'])->name('admin.destroyUser');
    });
});

require __DIR__ . '/auth.php';
