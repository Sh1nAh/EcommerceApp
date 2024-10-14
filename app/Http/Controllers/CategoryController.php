<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Category $category)
{
    // Start the query on the category's products
    $products = $category->products()->when(request('search'), function ($query) {
        $query->where('name', 'like', '%' . request('search') . '%');
    })->when(request('tag'), function ($query) {
        $query->whereHas('tags', function ($query) {
            $query->where('id', request('tag'));
        });
    })->paginate(12); // Use paginate here instead of get

    return view('categories.index', [
        'category' => $category,
        'products' => $products, // Use the modified products query
        'tags' => Tag::all(),
    ]);
}

}
