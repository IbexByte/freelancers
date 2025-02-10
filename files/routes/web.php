<?php

use App\Http\Controllers\CategoryController;
use App\Http\Middleware\LangSwicher;
use App\Livewire\ServiceAdmin;
use App\Livewire\UserProfile;
use App\Models\Category;
use DragonCode\Support\Facades\Filesystem\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Artisan;


Route::get('/', function () {
    $categories = Category::where('status', true)->latest()->take(8)->get();
    return view('welcome', compact('categories'));
})->middleware(LangSwicher::class);

Route::get('/storage-link', function () {
    Artisan::call('storage:link');
    return 'Storage linked successfully!';
});

 

Route::resource('categories', CategoryController::class);
Route::get('userProfile', UserProfile::class)->name('userProfile');
Route::get('services', ServiceAdmin::class)->name('services');

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
