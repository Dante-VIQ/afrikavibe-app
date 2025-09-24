<?php

use App\Models\Blog;
use App\Models\Doctor;
use App\Models\Comment;
use App\Models\Culture;
use App\Livewire\Welcome;
use App\Livewire\BlogCard;
use App\Livewire\BlogPage;
use App\Livewire\ShowBlog;
use App\Livewire\AboutPage;
use Spatie\Sitemap\Sitemap;
use App\Livewire\DoctorPage;
use App\Livewire\ShowDoctor;
use Spatie\Sitemap\Tags\Url;
use App\Livewire\ContactPage;
use App\Livewire\CultureCard;
use App\Livewire\CulturePage;
use App\Livewire\DoctorsCard;
use App\Livewire\ServicePage;
use App\Livewire\ShowCulture;
use App\Livewire\CommentModal;
use App\Livewire\AppontmentPage;
use App\Livewire\AnalysisDashboard;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\TrackingController;

Route::get('/sitemap.xml', function () {
    $sitemap = Sitemap::create()
        ->add(Url::create('/')->setPriority(1.0)->setChangeFrequency('daily'))
        ->add(Url::create('/destinations')->setPriority(0.8)->setChangeFrequency('weekly'))
        ->add(Url::create('/blogs')->setPriority(0.7)->setChangeFrequency('weekly'));

    // Add dynamic blog posts
    Blog::all()->each(function ($blog) use ($sitemap) {
        $sitemap->add(
            Url::create("/blogs/{$blog->slug}")
                ->setLastModificationDate($blog->updated_at)
                ->setChangeFrequency('weekly')
                ->setPriority(0.7)
        );
    });

    // Add dynamic cultures
    Culture::all()->each(function ($culture) use ($sitemap) {
        $sitemap->add(
            Url::create("/cultures/{$culture->slug}")
                ->setLastModificationDate($culture->updated_at)
                ->setChangeFrequency('weekly')
                ->setPriority(0.7)
        );
    });

    // Add dynamic doctors (I assume you meant Doctor, not Destination)
    Doctor::all()->each(function ($doctor) use ($sitemap) {
        $sitemap->add(
            Url::create("/doctors/{$doctor->slug}")
                ->setLastModificationDate($doctor->updated_at)
                ->setChangeFrequency('monthly')
                ->setPriority(0.6)
        );
    });

    // Write to file AND return response
    $sitemap->writeToFile(public_path('sitemap.xml'));

    return $sitemap->toResponse(request());
});

 


Route::get('/robots.txt', function () {
    $content = "User-agent: *\n"
             . "Disallow: /Analysis\n"
             . "Disallow: /admin\n"
             . "Disallow: /master\n"
             . "Disallow: /admin.php\n"
             . "Disallow: /master.php\n"
             . "Disallow: /admin/\n"
             . "Disallow: /master/\n\n"
             . "Sitemap: " . url('/sitemap.xml');

    return Response::make($content, 200, [
        'Content-Type' => 'text/plain',
    ]);
});

Route::view('/', 'welcome');

// Route::get('/',Welcome::class);

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::get('/service', ServicePage::class);

// Route::get('doctors', DoctorPage::class);
Route::get('/destination', function() {
    return view('destination');
})->name('destination');
Route::get('/doctor/{doctor}', ShowDoctor::class)->name('Partials.doctor');


Route::get('/about', AboutPage::class);

Route::get('/appointment', AppontmentPage::class);

Route::get('/contact', ContactPage::class);

// Route::get('cultures', CulturePage::class);
Route::get('/art', function() {
    return view('art');
})->name('art');
Route::get('culture/{culture}', ShowCulture::class)->name('Partials.culture');

// Route::get('/eco-destination', DoctorsCard::class);

// Route::get('/blog-lay', function () {
//     return view('blog-lay');
// })->name('blog-lay');

Route::get('/blog/{blog}', ShowBlog::class)->name('Partials.blog');
// Route::get('blogs', BlogPage::class);
//  Route::get('/blog', BlogPage::class);
Route::get('/blog', function() {
    return view('blog');
})->name('blog');


Route::post('track/view', [TrackingController::class, 'trackView']);

Route::middleware(['auth'])->group(function () {
    // Get comments
    // Route::get('/api/comments', function (Request $request) {
});

// List all partners
Route::get('/partners', [PartnerController::class, 'index'])->name('partners.index');

// Show form to create a partner
Route::get('/partners/create', [PartnerController::class, 'create'])->name('partners.create');

// Store a new partner
Route::post('/partners', [PartnerController::class, 'store'])->name('partners.store');

// Show a single partner profile
Route::get('/partners/{partner}', [PartnerController::class, 'show'])->name('partners.show');

// Show form to edit a partner
Route::get('/partners/{partner}/edit', [PartnerController::class, 'edit'])->name('partners.edit');

// Update a partner
Route::put('/partners/{partner}', [PartnerController::class, 'update'])->name('partners.update');
Route::patch('/partners/{partner}', [PartnerController::class, 'update']); // optional

// Delete a partner
Route::delete('/partners/{partner}', [PartnerController::class, 'destroy'])->name('partners.destroy');


// ================= ITEMS (nested under partners) =================

// List all items for a partner
Route::get('/partners/{partner}/items', [ItemController::class, 'index'])->name('partners.items.index');

// Show form to create an item for a partner
Route::get('/partners/{partner}/items/create', [ItemController::class, 'create'])->name('partners.items.create');

// Store a new item for a partner
Route::post('/partners/{partner}/items', [ItemController::class, 'store'])->name('partners.items.store');

// Show a single item
Route::get('/partners/{partner}/items/{item}', [ItemController::class, 'show'])->name('partners.items.show');

// Show form to edit an item
Route::get('/partners/{partner}/items/{item}/edit', [ItemController::class, 'edit'])->name('partners.items.edit');

// Update an item
Route::put('/partners/{partner}/items/{item}', [ItemController::class, 'update'])->name('partners.items.update');
Route::patch('/partners/{partner}/items/{item}', [ItemController::class, 'update']); // optional

// Delete an item
Route::delete('/partners/{partner}/items/{item}', [ItemController::class, 'destroy'])->name('partners.items.destroy');

// Route::middleware(['auth', 'role:admin'])->group(function () {
    require __DIR__ . '/admin.php';
// });

// Protect master routes
// Route::middleware(['auth', 'role:master'])->group(function () {
    require __DIR__ . '/master.php';
// });

// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified',
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });
