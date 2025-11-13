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
// REDIRECCIÓN RAÍZ
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

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout')
    ->middleware('auth');

// =============================
// LISTA PÚBLICA DE ARTESANOS
// =============================
Route::get('/artisans', [ProfileController::class, 'index'])->name('artisans.index');
Route::get('/artisans/{artisan}', [ProfileController::class, 'publicShow'])->name('artisans.profile');

// =============================
// PERFILES PRIVADOS (AUTH)
// =============================
Route::middleware(['auth'])->group(function () {
    Route::get('/projects/publish', [ProjectController::class, 'create'])->name('projects.publish');
    Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');
    Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
    Route::get('/projects/{project}/edit', [ProjectController::class, 'edit'])->name('projects.edit');
    Route::put('/projects/{project}', [ProjectController::class, 'update'])->name('projects.update');
});

// =============================
// PROYECTOS
// =============================
// Solo los usuarios autenticados pueden publicar o ver
Route::middleware(['auth'])->group(function () {
    Route::get('/projects/publish', [ProjectController::class, 'create'])->name('projects.publish');
    Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');
    Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
    Route::get('/projects/{project}/edit', [ProjectController::class, 'edit'])->name('projects.edit');
    Route::put('/projects/{project}', [ProjectController::class, 'update'])->name('projects.update');
});

// =============================
// VALORACIONES
// =============================
Route::middleware(['auth'])->group(function () {
    Route::get('/projects/{project}/ratings/create', [RatingController::class, 'create'])->name('ratings.create');
    Route::post('/projects/{project}/ratings', [RatingController::class, 'store'])->name('ratings.store');
    Route::get('/ratings', [RatingController::class, 'index'])->name('ratings.index');
});

// =============================
// ADMINISTRACIÓN
// =============================
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users.index');
    Route::delete('/admin/users/{id}', [AdminController::class, 'destroy'])->name('admin.users.destroy');
});

// =============================
// DASHBOARD
// =============================
Route::get('/home', [HomeController::class, 'index'])
    ->name('home')
    ->middleware('auth');


// =============================
// CONTACTO
// =============================
Route::get('/contacto', fn() => view('contacto'))->name('contacto.form');
Route::post('/contacto', [ContactController::class, 'submit'])->name('contacto.submit');

// =============================
// PRODUCTOS
// =============================
Route::get('/productos', [ProductoController::class, 'index'])->name('productos.index');
Route::get('/productos/categoria/{slug}', [ProductoController::class, 'mostrarPorCategoria'])->name('productos.categoria');

// =============================
// MENSAJES
// =============================
Route::middleware('auth')->group(function () {
    Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
    Route::get('/messages/{id}/send', [MessageController::class, 'showSendForm'])->name('messages.send.form');
    Route::post('/messages/{id}/send', [MessageController::class, 'send'])->name('messages.send');
});

Route::middleware(['admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
});
