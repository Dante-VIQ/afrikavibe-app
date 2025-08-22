<?php

use App\Models\Comment;
use App\Livewire\Welcome;
use App\Livewire\BlogCard;
use App\Livewire\BlogPage;
use App\Livewire\AboutPage;
use App\Livewire\DoctorPage;
use App\Livewire\ManageLink;
use App\Livewire\ContactPage;
use App\Livewire\CultureCard;
use App\Livewire\CulturePage;
use App\Livewire\DoctorsCard;
use App\Livewire\ServicePage;
use App\Livewire\AppontmentPage;
use App\Livewire\AnalysisDashboard;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\TrackingController;

Route::view('/', 'welcome');

Route::get('/',Welcome::class);

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

    Route::get('/service', ServicePage::class);

Route::get('/destination', DoctorPage::class);
Route::get('doctors', DoctorPage::class);


Route::get('/about', AboutPage::class);

Route::get('/appointment', AppontmentPage::class);

Route::get('/contact', ContactPage::class);

Route::get('/art', CulturePage::class);



// Route::get('/eco-destination', DoctorsCard::class);

// Route::get('/blog-lay', function () {
//     return view('blog-lay');
// })->name('blog-lay');

// Route::get('/blogs/{blog}', BlogPage::class, 'show');
// Route::get('/blogs/{blog}', BlogPage::class);
Route::get('/blog', BlogPage::class );
// Route::get('/blogs/{blog}', [BlogCard::class, 'show']);

Route::post('track/view', [TrackingController::class, 'trackView']);


require __DIR__ . '/admin.php';
require __DIR__ . '/master.php';


// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified',
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });
