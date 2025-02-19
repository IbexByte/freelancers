<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Service;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    //

    public function search(Request $request)
{
    $searchTerm = $request->input('query');

    // البحث في الخدمات
    $services = Service::where(function($query) use ($searchTerm) {
            $query->where('title', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('description', 'LIKE', "%{$searchTerm}%");
        })
        ->where('status', true)
        ->with('category')
        ->get();

    // البحث في التصنيفات
    $categories = Category::where(function($query) use ($searchTerm) {
            $query->where('name', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('description', 'LIKE', "%{$searchTerm}%");
        })
        ->where('status', true)
        ->get();

    return view('search.results', compact('services', 'categories', 'searchTerm'));
}

}
