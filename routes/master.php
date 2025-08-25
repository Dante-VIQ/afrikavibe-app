<?php


use App\Livewire\BlogCard;
use App\Livewire\AboutCard;
use App\Livewire\CultureCard;
use App\Livewire\DoctorsCard;
use App\Livewire\FeatureCard;
use App\Livewire\ServiceList;
use App\Livewire\DestinationCard;
use App\Livewire\AnalysisDashboard;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TrackingController;
use App\Http\Controllers\AnalyticsController;


Route::get('/Analysis', AnalysisDashboard::class);


// // Show Edit Form
Route::get('/abouts/{about}/edit', [AboutCard::class, 'edit']);

// // Update blog
Route::put('/abouts/{about}', [AboutCard::class, 'update']);

// Delete About
Route::delete('/abouts/{about}', [AboutCard::class, 'destroy']);

Route::get('/blogs', BlogCard::class);

// // Show Edit Form
Route::get('/blogs/{blog}/edit', [BlogCard::class, 'edit']);

// // Update blog
Route::put('/blogs/{blog}', [BlogCard::class, 'update']);

// // Delete blog
Route::delete('/blogs/{blog}', [BlogCard::class, 'destroy']);

// // // Manage blog
Route::get('/Blog/manage', [BlogCard::class, 'manage']);

// // Show Edit Form
Route::get('/features/{feature}/edit', [FeatureCard::class, 'edit']);

// // Update blog
Route::put('/features/{feature}', [FeatureCard::class, 'update']);

// // Delete blog
Route::delete('/features/{feature}', [FeatureCard::class, 'destroy']);

// // Show Edit Form
Route::get('/services/{service}/edit', [ServiceList::class, 'edit']);

// // Update blog
Route::put('/services/{service}', [ServiceList::class, 'update']);

// // Delete blog
Route::delete('/services/{service}', [ServiceList::class, 'destroy']);

Route::get('/arts', CultureCard::class);

// // Show Edit Form
Route::get('/cultures/{culture}/edit', [CultureCard::class, 'edit']);

// // Update blog
Route::put('/cultures/{culture}', [CultureCard::class, 'update']);

// // Delete blog
Route::delete('/cultures/{culture}', [CultureCard::class, 'destroy']);

Route::get('/doctors', DoctorsCard::class);


Route::get('/doctors/{doctor}/edit', [DoctorsCard::class, 'edit']);

// // Update blog
Route::put('/doctors/{doctor}', [DoctorsCard::class, 'update']);

// Delete About
Route::delete('/doctors/{doctor}', [DoctorsCard::class, 'destroy']);

// Route::middleware(['auth', 'role:admin,master'])->group(function () {

    Route::post('track/time-spent', [TrackingController::class, 'recordTimeSpent']);
    Route::get('/analytics/trends', [AnalyticsController::class, 'index']);
    Route::get('/admin/admin', [AnalyticsController::class, 'index'])->name('admin.admin');
    // Route::get('/api/analytics/activity-trends', [AnalyticsController::class, 'activityTrends']);


// });

// // // Manage blog
// Route::get('/Blog/manage', [BlogCard::class, 'manage']);
// Route::resource('about', AboutCard::class);
// Route::resource('destination', DestinationCard::class);
// Route::resource ('service', ServiceList::class);
