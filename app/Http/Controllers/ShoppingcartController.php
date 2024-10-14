<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Http\Request;

class ShoppingcartController extends Controller
{
    public function index() {
        return view('shoppingcart');
    }

    public function addToCart(Request $request, $productId)
    {
        // Retrieve the authenticated user
        $user = auth()->guard()->user();

        // Check if the user has a cart; if not, create one
        $cart = $user->cart ?? Cart::create(['user_id' => $user->id]);

        // Check if the cart already contains the product
        $cartItem = $cart->cart_items()->where('product_id', $productId)->first();

        // Retrieve the product's price and discount
        $product = Product::findOrFail($productId);
        
        // Calculate the price after discount
        $discount = ($product->price / 100) * $product->discountpercentage;
        $finalPrice = $product->price - $discount;

        if ($cartItem) {
            // If the item exists, increment the quantity and update price
            $cartItem->quantity += 1;
            // Update the price in case there was a price change
            $cartItem->price = $finalPrice * $cartItem->quantity; // Total price for the updated quantity
            $cartItem->save();
        } else {
            // If the item does not exist, create a new cart item
            $cartItem = new CartItem([
                'product_id' => $productId,
                'quantity' => 1, // Set initial quantity to 1
                'price' => $finalPrice, // Set the discounted price
            ]);
            $cart->cart_items()->save($cartItem);
        }
        
        return redirect()->back()->with('success', 'Product added to cart!');
    }

    public function update(Request $request, $id)
    {
        $request->validate(['quantity' => 'required|integer|min:1']);
        
        $cartItem = CartItem::findOrFail($id);
        
        // Retrieve the product's price and discount
        $product = Product::findOrFail($cartItem->product_id);
        $discount = ($product->price / 100) * $product->discountpercentage;
        $finalPrice = $product->price - $discount;

        // Update quantity and recalculate total price
        $cartItem->quantity = $request->quantity;
        $cartItem->price = $finalPrice * $request->quantity; // Update price based on new quantity
        $cartItem->save();

        return response()->json(['success' => true, 'message' => 'Quantity updated successfully.']);
    }

    
    // public function store(Product $product) {
    //     if(!auth()->guard()->user()->cart) {
    //     $cart = new Cart();
    //     $cart->user_id = auth()->guard()->user()->id;
    //     $cart->save();
    // }
    // else {
    //     $cart = auth()->guard()->user()->cart;
    // }

    //     $cart = $cart ?? auth()->guard()->user()->cart;
    //     $cartItem = new CartItem();
    //     $cartItem->cart_id = $cart->id;
    //     $cartItem->product_id = $product->id;
    //     $cartItem->save();
    //     return redirect('/products');
    // }

    public function destroy(CartItem $cartitem) {
        $cartitem->delete();
        return back();
    }

}