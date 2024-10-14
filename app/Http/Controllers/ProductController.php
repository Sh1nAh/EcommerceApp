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

    // public function store() {
    //     request()->validate([
    //         'image' => ['required', 'image'],
    //         'name' => 'required',
    //         'slug' => 'required',
    //         'subtext' => 'required',
    //         'color' => 'required',
    //         'price' => 'required',
    //         'description' => 'required',
    //         'chipicon' => ['required', 'image'],
    //         'chiptext' => 'required',
            
    //         'discount_percentage' => ['required', 'max:2'],
    //         'category_id' => 'required',
    //     ]);

    //     $image = request('image');
    //     $product = new Product();
    //     $product->image = '/storage/' . $image->storeAs('products', $image->getClientOriginalName());
    //     $product->name = request('name');
    //     $product->slug = request('slug');
    //     $product->price = request('price');
    //     $product->discountpercentage = request('discount_percentage');
    //     $product->category_id = request('category_id');
    //     $product->save();
    //     return redirect('/admin/products');
    // }

    public function edit(Product $product) {
        return view('admin.edit-product', [
            "categories" => Category::all(),
            "product" => $product
        ]);
    }

    public function update($id) {
        $product = Product::findOrFail($id);
    
        request()->validate([
            'name' => 'required',
            'slug' => 'required',
            'color' => 'required',
            'price' => 'required',
            'description' => 'required',
            'category_id' => 'required',
            // Add validation for icons if necessary
        ]);
    
        // Update image if uploaded
        if (request()->hasFile('image')) {
            $image = request('image');
            $product->image = '/storage/' . $image->storeAs('products', $image->getClientOriginalName());
        }
    
        $product->name = request('name');
        $product->slug = request('slug');
        $product->subtext = request('subtext');
        $product->color = request('color');
        $product->price = request('price');
        $product->description = request('description');
    
        // Update icons if uploaded
        if (request()->hasFile('icon1')) {
            $icon1 = request('icon1');
            $product->icon1 = '/storage/' . $icon1->storeAs('icons', uniqid() . '-' . $icon1->getClientOriginalName());
        }
        $product->icon1text = request('icon1text');
    
        if (request()->hasFile('icon2')) {
            $icon2 = request('icon2');
            $product->icon2 = '/storage/' . $icon2->storeAs('icons', uniqid() . '-' . $icon2->getClientOriginalName());
        }
        $product->icon2text = request('icon2text');
    
        if (request()->hasFile('icon3')) {
            $icon3 = request('icon3');
            $product->icon3 = '/storage/' . $icon3->storeAs('icons', uniqid() . '-' . $icon3->getClientOriginalName());
        }
        $product->icon3text = request('icon3text');
    
        $product->discountpercentage = request('discount_percentage');
        $product->category_id = request('category_id');
        
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
