<?php


use App\Livewire\Adboard;
use App\Livewire\BlogCard;
use App\Livewire\AboutCard;
use App\Livewire\HeaderCard;
use App\Livewire\CultureCard;
use App\Livewire\ServiceList;
use App\Livewire\DestinationCard;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TrackingController;
use App\Http\Controllers\AnalyticsController;




// // // Show Edit Form
// Route::get('/blogs/{blog}/edit', [BlogCard::class, 'edit']);

// // // Update blog
// Route::put('/blogs/{blog}', [BlogCard::class, 'update']);

// // // // Manage blog
// Route::get('/Blog/manage', [BlogCard::class, 'manage']);

Route::get('/page', CultureCard::class);

Route::get('/header', HeaderCard::class);

// Route::post('track/view', [TrackingController::class, 'trackView']);
// Route::middleware(['auth', 'role:admin,master'])->group(function () {

    // Route::get('/api/analytics/activity-trends', [AnalyticsController::class, 'activityTrends']);


// });
// Route::resource('/', AboutCard::class);
// Route::resource('destination', DestinationCard::class);
// Route::resource ('service', ServiceList::class);
