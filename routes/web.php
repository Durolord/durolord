<?php

use App\Http\Controllers\Profile\ProfileController;
use App\Http\Controllers\Profile\SessionController;
use App\Http\Middleware\OnlyAnalyticsUser;
use App\Livewire\Dashboard\Analytics as AnalyticsDashboard;
use App\Livewire\Landing\Hero;
use App\Livewire\Landing\Showcase;
use App\Livewire\Services\Create as ServicesCreate;
use App\Livewire\Services\Edit as ServicesEdit;
use App\Livewire\Services\Index as ServicesIndex;
use App\Livewire\Showcase\Elements;
use App\Livewire\Showcase\FormComponents;
use App\Livewire\Showcase\TableComponents;
use App\Models\ContactInquiry;
use App\Models\Service;
use Illuminate\Support\Facades\Route;

Route::get('/', Hero::class)->name('home');
Route::get('/showcase', Showcase::class)->name('showcase');
Route::get('/form-components', FormComponents::class)->name('form-components');
Route::get('/table-components', TableComponents::class)->name('table-components');
Route::get('/elements', Elements::class)->name('elements');

Route::middleware(['auth'])
    ->group(function () {
        Route::get('/profile', ProfileController::class)->name('profile');
        Route::delete('/profile/sessions', SessionController::class)->name('profile.sessions.destroy');

        Route::prefix('services')->group(function () {
            Route::get('/', ServicesIndex::class)->name('services.index');
            Route::get('/create', ServicesCreate::class)->name('services.create');
            Route::get('/{service}/edit', ServicesEdit::class)->name('services.edit');
        });

        Route::get('/dashboard/analytics', AnalyticsDashboard::class)
            ->middleware(OnlyAnalyticsUser::class)
            ->name('dashboard.analytics');
    });

Route::middleware(['auth', 'verified'])
    ->group(function () {
        Route::get('/dashboard', function () {
            return view('dashboard', [
                'serviceCount' => Service::count(),
                'inquiryCount' => ContactInquiry::count(),
                'unreadInquiryCount' => ContactInquiry::unread()->count(),
                'recentInquiries' => ContactInquiry::latest()->limit(5)->get(),
            ]);
        })->name('dashboard');
    });
