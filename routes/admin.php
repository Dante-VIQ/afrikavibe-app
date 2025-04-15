<?php


use App\Livewire\Adboard;
use App\Livewire\BlogCard;
use App\Livewire\AboutCard;
use App\Livewire\CultureCard;
use App\Livewire\ServiceList;
use App\Livewire\DestinationCard;
use Illuminate\Support\Facades\Route;




// // Show Edit Form
Route::get('/blogs/{blog}/edit', [BlogCard::class, 'edit']);

// // Update blog
Route::put('/blogs/{blog}', [BlogCard::class, 'update']);

// // // Manage blog
Route::get('/Blog/manage', [BlogCard::class, 'manage']);

Route::get('/page', CultureCard::class);

// Route::resource('/', AboutCard::class);
// Route::resource('destination', DestinationCard::class);
// Route::resource ('service', ServiceList::class);
