<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function home() {
        // for groupBy
        // $products = Product::all('id', 'category_id', 'image','name', 'slug', 'price', 'color', 'discountpercentage')
        //     ->groupBy('category_id')
        //     ->orderBy('id')
        //     ->get();
        // "products" => $products
        
        $latestdiscountproduct = Product::where('discountpercentage', '>', 0)->orderBy('discountpercentage', 'desc')->first();
        return view('home', [
            // for latest discount product
            "products" => Product::with('category')->paginate(12),
            "categories" => Category::all(),
            "latestdiscountproduct" => $latestdiscountproduct
        ]);
    }

    public function index() {
        // $products= Product::where('name', 'LIKE', '%' .request('search').'%')
        //     // ->with('category')
        //     ->paginate(3);
        // // $products->withPath('products');
        // if(request('tag'))
        // {
        //     $tag = Tag::find(request('tag'));
        //     $products = $tag->products()->paginate(3);
        // }
        return view('products', [
            "products" => Product::filter([
                'search' => request('search'),
                'tag' => request('tag')
            ])->paginate(12),
            "tags" => Tag::all()
        ]);
    }

    public function show(Product $product) {
        return view('detail', [
            "product" => $product
        ]);
    }

    public function products() {
        $products = Product::with('category')->latest()->paginate(10);
        return view('admin.products', [
            "products" => $products
        ]);
    }

    public function create() {
        return view('admin.create-product', [
            "categories" => Category::all()
        ]);
    }

    public function store() {
        request()->validate([
            'image' => ['required', 'image'],
            'name' => 'required',
            'slug' => 'required',
            'price' => 'required|numeric', // Ensure price is numeric
            'color' => 'required',
            'description' => 'required',
            'category' => 'required|exists:categories,id',
            'icon1' => 'nullable|image',
            'icon2' => 'nullable|image',
            'icon3' => 'nullable|image',
        ]);
    
        $product = new Product();
        $product->image = '/storage/' . request('image')->storeAs('products', request('image')->getClientOriginalName());
        $product->name = request('name'); // Corrected to 'name' from 'product_name'
        $product->slug = request('slug');
        $product->subtext = request('subtext');
        $product->price = request('price');
        $product->color = request('color');
        $product->description = request('description');
    
        // Handle icons if they are provided
        if (request()->hasFile('icon1')) {
            $icon1 = request('icon1');
            $product->icon1 = '/storage/' . $icon1->storeAs('icons', uniqid() . '-' . $icon1->getClientOriginalName());
            $product->icon1text = request('icon1text');
        }
    
        if (request()->hasFile('icon2')) {
            $icon2 = request('icon2');
            $product->icon2 = '/storage/' . $icon2->storeAs('icons', uniqid() . '-' . $icon2->getClientOriginalName());
            $product->icon2text = request('icon2text');
        }
    
        if (request()->hasFile('icon3')) {
            $icon3 = request('icon3');
            $product->icon3 = '/storage/' . $icon3->storeAs('icons', uniqid() . '-' . $icon3->getClientOriginalName());
            $product->icon3text = request('icon3text');
        }
    
        $product->discountpercentage = request('discountpercentage') ?? 0;
        $product->category_id = request('category');
        $product->save();
    
        return redirect('/admin/products');
    }
    

    public function edit(Product $product) {
        return view('admin.edit-product', [
            "categories" => Category::all(),
            "product" => $product
        ]);
    }

    public function update($id) {
        $product = Product::findOrFail($id);
    
        request()->validate([
            'image' => 'nullable|image', // Make image optional
            'name' => 'required',
            'slug' => 'required',
            'price' => 'required|numeric', // Ensure price is numeric
            'color' => 'required',
            'description' => 'required',
            'category' => 'required|exists:categories,id',
            'icon1' => 'nullable|image',
            'icon2' => 'nullable|image',
            'icon3' => 'nullable|image',
        ]);
    
        // Update image if a new one is uploaded
        if (request()->hasFile('image')) {
            $image = request('image');
            $product->image = '/storage/' . $image->storeAs('products', $image->getClientOriginalName());
        }
    
        // Always update other fields
        $product->name = request('name');
        $product->slug = request('slug');
        $product->subtext = request('subtext');
        $product->color = request('color');
        $product->price = request('price');
        $product->description = request('description');
        $product->category_id = request('category');
    
        // Update icons if uploaded
        if (request()->hasFile('icon1')) {
            $icon1 = request('icon1');
            $product->icon1 = '/storage/' . $icon1->storeAs('icons', uniqid() . '-' . $icon1->getClientOriginalName());
        }
        $product->icon1text = request('icon1text', $product->icon1text); // Retain existing value if not provided
    
        if (request()->hasFile('icon2')) {
            $icon2 = request('icon2');
            $product->icon2 = '/storage/' . $icon2->storeAs('icons', uniqid() . '-' . $icon2->getClientOriginalName());
        }
        $product->icon2text = request('icon2text', $product->icon2text); // Retain existing value if not provided
    
        if (request()->hasFile('icon3')) {
            $icon3 = request('icon3');
            $product->icon3 = '/storage/' . $icon3->storeAs('icons', uniqid() . '-' . $icon3->getClientOriginalName());
        }
        $product->icon3text = request('icon3text', $product->icon3text); // Retain existing value if not provided
    
        $product->discountpercentage = request('discount_percentage', $product->discountpercentage); // Retain existing value if not provided
    
        $product->save();
    
        return redirect('/admin/products');
    }
    
    

    public function detail(Product $product)
    {
        return view('admin.product-details', [
            "product" => $product
        ]);
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return back();
    }
}
