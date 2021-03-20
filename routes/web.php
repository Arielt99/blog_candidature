<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::namespace('posts')->group(function () {
        Route::get('/posts', [PostController::class,'index'])->name('PostsList');
        Route::get('/posts-create', [PostController::class,'create'])->name('PostCreation');
        Route::post('/posts-create', [PostController::class,'store'])->name('PostAdding');
        Route::get('/posts/{id}', [PostController::class,'show'])->name('PostDisplay');
        Route::get('/posts-edit/{id}', [PostController::class,'edit'])->name('PostEdition');
        Route::put('/posts-edit/{id}', [PostController::class,'update'])->name('PostUpdating');
        Route::delete('/posts-destroy/{id}', [PostController::class,'destroy'])->name('PostDestroying');
    });

    Route::namespace('users')->group(function(){
        Route::get('/users', [UserController::class,'index'])->name('RoleManager');
        Route::get('/users/{id}', [UserController::class,'show'])->name('AuthorProfile');
        Route::put('/users/{id}', [UserController::class,'update'])->name('UserRoleUpdate');
    });
});

