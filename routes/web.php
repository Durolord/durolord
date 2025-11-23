<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Landing\Hero;
use App\Livewire\Landing\Showcase;
use App\Livewire\Showcase\FormComponents;
use App\Livewire\Showcase\TableComponents;

Route::get('/', Hero::class)->name('home');
Route::get('/showcase', Showcase::class)->name('showcase');
Route::get('/form-components', FormComponents::class)->name('form-components');
Route::get('/table-components', TableComponents::class)->name('Table-components');

Route::middleware(['auth', 'verified'])
    ->group(function () {
        Route::get('/dashboard', function () {
            return view('dashboard');
        })->name('dashboard');
    });