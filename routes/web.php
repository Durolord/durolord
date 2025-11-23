<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Landing\Hero;
use App\Livewire\Landing\Showcase;

Route::get('/', Hero::class)->name('home');
Route::get('/showcase', Showcase::class)->name('showcase');

Route::middleware(['auth', 'verified'])
    ->group(function () {
        Route::get('/dashboard', function () {
            return view('dashboard');
        })->name('dashboard');
    });