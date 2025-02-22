<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SearchController;
use App\Http\Middleware\LangSwicher;
use App\Livewire\Cart;
use App\Livewire\CategoriesIndex;
use App\Livewire\ChatComponent;
use App\Livewire\IncomingOrders;
use App\Livewire\MyServices;
use App\Livewire\OrderDetails;
use App\Livewire\ServiceAdmin;
use App\Livewire\ServiceShow;
use App\Livewire\UserProfile;
use App\Models\Category;
use DragonCode\Support\Facades\Filesystem\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Artisan;


Route::get('/', function () {
    $categories = Category::where('status', true)->latest()->take(8)->get();
    return view('welcome', compact('categories'));
})->middleware(LangSwicher::class)->name('home');

Route::get('/storage-link', function () {
    Artisan::call('storage:link');
    return 'Storage linked successfully!';
});

 
Route::get('/search', [SearchController::class, 'search'])->name('search');

Route::resource('categories', CategoryController::class);
Route::get('incoming-orders', IncomingOrders::class)->name('incoming-orders');
Route::get('my-items', Cart::class)->name('cart.index');
Route::get('/chat', ChatComponent::class)->name('chat');
Route::get('userProfile', UserProfile::class)->name('userProfile');
Route::get('services', ServiceAdmin::class)->name('services');
Route::get('service/{service}', ServiceShow::class)->name('services.show');
Route::get('category/{category}/show', CategoriesIndex::class)->name('category.show');
Route::get('order/{orderId}/deteal', OrderDetails::class)->name('order.deteal');
Route::get('my', MyServices::class)->name('user.purchase');

Route::get('lang/{lang}', function ($lang) {
    // List of supported languages
    $supportedLocales = ['en', 'ar']; // Add/remove as needed

    // Check if the requested language is supported
    if (!in_array($lang, $supportedLocales)) {
        // Option 1: Redirect back with error message
        return redirect()->back()->with('error', 'Unsupported language');

        // Option 2: Abort with 404
        // abort(404);
    }

    // Store the selected language in the session
    Session::put('applocale', $lang);

    // Set the application locale for current request
    app()->setLocale($lang);

    // Redirect back to the previous page
    return redirect()->back();
})->middleware(LangSwicher::class);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
