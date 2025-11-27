<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\DashboardController;

// =============================
// RAÍZ
// =============================
Route::get('/', function () {
    return Auth::check() ? redirect()->route('home') : redirect()->route('login');
});

// =============================
// AUTENTICACIÓN
// =============================
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// =============================
// VALORACIONES PÚBLICAS
// =============================
Route::get('/gallery', [RatingController::class, 'gallery'])
    ->name('ratings.gallery');

Route::get('/ratings', fn() => redirect()->route('ratings.gallery'));

// =============================
// RUTAS PÚBLICAS
// =============================
Route::get('/artisans', [ProfileController::class, 'index'])->name('artisans.index');
Route::get('/artisans/{artisan}', [ProfileController::class, 'publicShow'])->name('artisans.profile');
Route::get('/contacto', fn() => view('contacto'))->name('contacto.form');
Route::post('/contacto', [ContactController::class, 'submit'])->name('contacto.submit');
Route::get('/productos', [ProductoController::class, 'index'])->name('productos.index');
Route::get('/productos/categoria/{slug}', [ProductoController::class, 'mostrarPorCategoria'])->name('productos.categoria');

// =============================
// RUTAS AUTENTICADAS
// =============================
Route::middleware('auth')->group(function () {

    // HOME
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // === PERFIL ===
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'show'])->name('show');
        Route::get('/create', [ProfileController::class, 'create'])->name('create');
        Route::post('/', [ProfileController::class, 'store'])->name('store');
        Route::get('/edit', [ProfileController::class, 'edit'])->name('edit');
        Route::match(['put', 'patch'], '/', [ProfileController::class, 'update'])->name('update');
    });

    // === PROYECTOS ===
    Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
    Route::get('/projects/create', [ProjectController::class, 'create'])->name('projects.publish');
    Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');
    Route::get('/projects/{project}', [ProjectController::class, 'show'])->name('projects.show');
    Route::get('/projects/{project}/edit', [ProjectController::class, 'edit'])->name('projects.edit');
    Route::put('/projects/{project}', [ProjectController::class, 'update'])->name('projects.update');
    Route::post('/projects/{project}/take', [ProjectController::class, 'take'])->name('projects.take');

    // === MENSAJES ===
    Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
    Route::get('/messages/{id}/send', [MessageController::class, 'showSendForm'])->name('messages.send.form');
    Route::post('/messages/{id}/send', [MessageController::class, 'send'])->name('messages.send');

    // === VALORACIONES (solo autenticados) ===
    Route::get('/ratings/pending', [RatingController::class, 'pending'])
        ->name('ratings.pending');

    Route::get('/ratings/{project}/create', [RatingController::class, 'create'])
        ->name('ratings.create');

        Route::post('/projects/{project}/rating', [RatingController::class, 'store'])
        ->name('ratings.store');
});

// =============================
// ADMIN
// =============================
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/users', [AdminController::class, 'users'])->name('users.index');
    Route::delete('/users/{id}', [AdminController::class, 'destroy'])->name('users.destroy');
});