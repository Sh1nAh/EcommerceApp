<?php

namespace App\Http\Controllers;

use App\Mail\OrderConfirm;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderDetail;
use App\Models\Cart;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    // public function index($orderId)
    // {
    //     $order = Order::with('orderItems.product')
    //         ->where('id', $orderId)
    //         ->where('user_id', auth()->guard()->user()->id) // Using auth()->user() directly
    //         ->first();

    //     // If there's no order, handle it (redirect or show a message)
    //     if (!$order) {
    //         return redirect('/')->with('error', 'No order found.');
    //     }

    //     // Pass the order to the view
    //     return view('checkout', compact('order'));
    // }

    public function index()
    {
        $cart = Cart::where('user_id', auth()->guard()->user()->id)->first();
        $cartItems = $cart->cart_items()->with('product')->get();

        // Calculate total price and total quantity
        $totalPrice = $cartItems->sum('price'); // Total price for all items
        $totalQuantity = $cartItems->sum('quantity'); // Total quantity of items

        // Pass the cart items and totals to the view
        return view('checkout', [
            'cartItems' => $cartItems,
            'totalPrice' => $totalPrice,
            'totalQuantity' => $totalQuantity,
        ]);
    }    

    // public function store(Request $request) {
    //     // Validate the checkout form data
    //     $validatedData = $request->validate([
    //         'order_id' => 'required|exists:orders,id', // Ensure order ID is valid
    //         'phone_number' => 'required|string',
    //         'address' => 'required|string',
    //         'township' => 'required|string',
    //         'city' => 'required|string',
    //         'notes' => 'nullable|string',
    //         'payment_method' => 'required|string',
    //         'payment_receipt' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
    //     ]);

    //     // Handle the file upload
    //     $receiptPath = $request->file('payment_receipt')->store('receipts'); // Save to 'storage/app/receipts'

    //     // Create OrderDetail entry
    //     $orderDetail = new OrderDetail();
    //     $orderDetail->order_id = $validatedData['order_id']; // Retrieve order ID from validated data
    //     $orderDetail->phone_number = $validatedData['phone_number'];
    //     $orderDetail->address = $validatedData['address'];
    //     $orderDetail->township = $validatedData['township'];
    //     $orderDetail->city = $validatedData['city'];
    //     $orderDetail->notes = $validatedData['notes'];
    //     $orderDetail->payment_method = $validatedData['payment_method'];
    //     $orderDetail->payment_receipt = $receiptPath; // Store the path to the receipt
    //     $orderDetail->save();

    //     // Send confirmation email
    //     Mail::to(auth()->guard()->user()->email)->queue(new OrderConfirm(auth()->guard()->user()->name));

    //     // Redirect to home or a confirmation page
    //     return redirect()->route('home')->with('success', 'Order confirmed successfully!');
    // }
}
