<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

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




Volt::route('/login', 'pages.auth.login')->name('login');

Volt::route('/', 'posts.index')->name('posts.index');

Route::middleware(['auth', 'verified'])->group(function () {
    Volt::route('/posts/create', 'posts.create');
    Volt::route('/posts/{post}/edit', 'posts.edit');
    Volt::route('/profile', 'profile');
});

Volt::route('/posts/{post}', 'posts.show')->name('posts.show');

Route::middleware(['auth','verified'])->group(function () {
    Volt::route('/edit-profile', 'edit-profile');
    Volt::route('verify-email', 'pages.auth.verify-email')
        ->name('verification.notice');
});


require __DIR__.'/auth.php';
