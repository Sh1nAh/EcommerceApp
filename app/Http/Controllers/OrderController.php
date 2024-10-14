<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderDetail;
use App\Mail\OrderConfirm;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
class OrderController extends Controller
{
    // public function store()
    // {
    //     request()->validate([
    //         'shipping_address' => 'required',
    //         'total_amount' => 'required',
    //     ]);

    //     $products = collect([]);
    //     auth()->guard()->user()?->cart?->cart_items->load('product')->each(function ($cartItem) use (&$products) {
    //         $product = [];
    //         $product['id'] = $cartItem->product->id;
    //         $product['price'] = $cartItem->product->price;
    //         $products[] = $product;
    //     });

    //     $order = new Order();
    //     $order->user_id = auth()->guard()->user()->id;
    //     $order->total_amount = request('total_amount');
    //     $order->shipping_address = request('shipping_address');
    //     $order->save();

    //     $products->each(function ($product) use ($order) {
    //         $orderItem = new OrderItem();
    //         $orderItem->order_id = $order->id;
    //         $orderItem->product_id = $product['id'];
    //         $orderItem->price = $product['price'];
    //         $orderItem->save();
    //     });

    //     auth()->guard()->user()?->cart?->cart_items()->delete();
        
    //     Mail::to(auth()->guard()->user()->email)->queue(new OrderConfirm(auth()->guard()->user()->name));
    //     return back()->with('success', 'Order created successfully');
    // }
    public function store(Request $request)
    {
        // Validate the incoming data
        $validatedData = $request->validate([
            'phone_number' => 'required|string',
            'address' => 'required|string',
            'township' => 'required|string',
            'city' => 'required|string',
            'notes' => 'nullable|string',
            'payment_method' => 'required|string',
            'payment_receipt' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);
    
        // Create the order and get the total amount from the user's cart
        $user = auth()->guard()->user();
        $cart = $user->cart;
        $totalAmount = $cart->cart_items()->sum('price'); // Assuming price includes quantity
    
        $order = new Order();
        $order->user_id = $user->id;
        $order->total_amount = $totalAmount; // Set the total amount from the cart
        $order->save();
    
        // Handle the file upload for the payment receipt
        $receiptPath = $request->file('payment_receipt')->store('receipts');
    
        // Create OrderDetail entry
        $orderDetail = new OrderDetail();
        $orderDetail->order_id = $order->id;
        $orderDetail->phone_number = $validatedData['phone_number'];
        $orderDetail->address = $validatedData['address'];
        $orderDetail->township = $validatedData['township'];
        $orderDetail->city = $validatedData['city'];
        $orderDetail->notes = $validatedData['notes'];
        $orderDetail->payment_method = $validatedData['payment_method'];
        $orderDetail->payment_receipt = $receiptPath;
        $orderDetail->save();
    
        // Add order items based on the user's cart
        foreach ($cart->cart_items as $cartItem) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $cartItem->product_id,
                'quantity' => $cartItem->quantity,
                'price' => $cartItem->price,
            ]);
        }
    
        // Send confirmation email (if needed)
        // Mail::to($user->email)->queue(new OrderConfirm($user->name));
        auth()->guard()->user()?->cart?->cart_items()->delete();
        Mail::to(auth()->guard()->user()->email)->queue(new OrderConfirm(auth()->guard()->user()->name));
        
        return redirect()->route('home')->with('success', 'Order confirmed successfully!');
    }

    public function edit(Order $order) {
        return view('admin.edit-order', [
            'order' => $order,
            'orderDetails' => $order->orderDetails
        ]);
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return back();
    }

    public function history()
    {
        $orders = Order::where('user_id', auth()->guard()->user()?->id)
            ->with('orderItems')
            ->latest()
            ->paginate(5);
        return view('order-history', [
            'orders' => $orders
        ]);
    }

    public function show(Order $order)
    {
        return view('admin.order-details', [
            'order' => $order,
            'orderDetails' => $order->orderDetails
        ]);
    }

    public function update(Order $order) {
        $order->status = request('status');
        $order->save();
        return redirect('/admin/orders');
    }
}