<?php

use App\Livewire\BlogCard;
use App\Livewire\BlogPage;
use App\Livewire\AboutPage;
use App\Livewire\DoctorPage;
use App\Livewire\ContactPage;
use App\Livewire\CultureCard;
use App\Livewire\ServicePage;
use App\Livewire\AppontmentPage;
use App\Livewire\AnalysisDashboard;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

    Route::get('/service', ServicePage::class);

Route::get('/destination', DoctorPage::class);

Route::get('/about', AboutPage::class);

Route::get('/appointment', AppontmentPage::class);

Route::get('/contact', ContactPage::class);

Route::get('/page', CultureCard::class);


// Route::get('/blog-lay', function () {
//     return view('blog-lay');
// })->name('blog-lay');

// Route::get('/blogs/{blog}', BlogPage::class, 'show');
Route::get('/blogs/{blog}', BlogPage::class);
Route::get('/main', BlogCard::class);
Route::get('/blogs/{blog}', [BlogCard::class, 'show']);

Route::get('/Analysis', AnalysisDashboard::class);



// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified',
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });
