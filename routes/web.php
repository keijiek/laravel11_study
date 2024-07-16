<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\PostController;


Route::get('/', function () {
    return view('welcome');
})
    /** ->middleware('can:test') */
;

// Route::get('post/create', [PostController::class, 'create']); // admin ミドルウェア追加
Route::post('post', [PostController::class, 'store'])->name('post.store');
Route::get('post', [PostController::class, 'index'])->name('post.index');
Route::get('post/{post}/edit', [PostController::class, 'edit'])->name('post.edit');
Route::patch('post/{post}', [PostController::class, 'update'])->name('post.update');
Route::delete('post/{post}', [PostController::class, 'destroy'])->name('post.destroy');

Route::get('post/show/{post}', [PostController::class, 'show'])->name('post.show');

Route::get('/test', [TestController::class, 'test'])->name('test');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('post/create', [PostController::class, 'create']);
});

require __DIR__ . '/auth.php';
