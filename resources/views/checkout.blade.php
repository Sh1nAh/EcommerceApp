<!-- custom css file link -->
<link rel="stylesheet" href="{{ asset('css/styles.css') }}">
<link rel="stylesheet" href="{{ asset('css/customstyles.css') }}">

<x-layout>
    <!-- checkout section starts -->  
    <section class="checkout">
        <h1 class="heading"><span>check</span>out</h1>
        <div class="checkoutlayout justify-content-center align-items-center">
            <div class="row">
                <div class="returncart col-lg-5">
                    <div class="test2">
                        <a href="/"><span class="fas fa-arrow-left"></span> continue shopping</a>
                    </div>
                    <div class="test">
                        <h3>Your Order</h3>
                    </div>
                    <div class="card StyledReceipt">
                        <div class="card-body">
                            @foreach ($cartItems as $item)
                            <div class="item d-flex justify-content-between">
                                <div class="d-flex flex-row align-items-center justify-content-between">
                                    <div class="imagecontainer">
                                        <img src="{{ $item->product->image }}" alt="{{ $item->product->name }}">
                                    </div>
                                    <div class="info" style="text-align: left; padding-left: 1rem;">
                                        <div class="name">{{ $item->product->name }}</div>
                                        <div class="color">{{ $item->product->color }}</div> {{-- Assuming color is a property of cart item --}}
                                    </div>
                                </div>
                                <div class="d-flex flex-row align-items-center">
                                    <div class="quantity">{{ $item->quantity }}</div>
                                    <div class="price">${{ number_format($item->price ?? 0, 2) }}</div> {{-- Use null coalescing operator --}}
                                </div>
                            </div>                            
                            @endforeach
                            <div class="return">
                                <div class="total">
                                    <div>Quantity</div>
                                    <div class="quantity">{{ $totalQuantity }}</div>
                                </div>
                                <div class="total">
                                    <div>Subtotal</div>
                                    <div class="subtotal">${{ number_format($totalPrice ?? 0, 2) }}</div> {{-- Use null coalescing operator --}}
                                </div>
                            </div>
                            <div class="total">
                                <div>Shipping</div>
                                <div class="shipping">Free</div> {{-- Adjust as needed based on your logic --}}
                            </div>
                            <div class="total">
                                <div>Total</div>
                                <div class="totalprice">${{ number_format($totalPrice ?? 0, 2) }}</div> {{-- Use null coalescing operator --}}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="p-4 col-lg-7" style="gap: 2rem; padding-right: 0; margin-bottom: 3rem;">
                    <h3>Shipping Address</h3>
                    <form action="{{ route('order.confirm') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form">
                            <div class="group">
                                <label for="phone_number">Phone Number</label>
                                <input type="text" name="phone_number" required>
                            </div>
                            <div class="group">
                                <label for="address">Address</label>
                                <textarea name="address" required></textarea>
                            </div>
                            <div class="sel">
                                <div class="group">
                                    <label for="township">Township</label>
                                    <select name="township" required>
                                        <option value="">Choose..</option>
                                        <option value="insein">Insein</option>
                                        <option value="bahan">Bahan</option>
                                        <option value="dagon">Dagon</option>
                                    </select>
                                </div>
                                <div class="group">
                                    <label for="city">City</label>
                                    <select name="city" required>
                                        <option value="">Choose..</option>
                                        <option value="yangon">Yangon</option>
                                        <option value="mandalay">Mandalay</option>
                                        <option value="naypyitaw">Naypyitaw</option>
                                    </select>
                                </div>
                            </div>
                            <div class="group">
                                <label for="notes">Notes:</label>
                                <textarea name="notes"></textarea>
                            </div>
                            <div class="group">
                                <label for="payment_method">Payment Method:</label>
                                <select name="payment_method" required>
                                    <option value="credit_card">Credit Card</option>
                                    <option value="paypal">PayPal</option>
                                    <!-- Add other payment methods as needed -->
                                </select>
                            </div>
                            <div class="group">
                                <label for="payment_receipt">Payment Receipt:</label>
                                <input type="file" name="payment_receipt" required>
                            </div>
                            <div style="text-align: center;">
                                <button type="submit" class="btncheckout">Submit</button>
                            </div>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>  
    </section>
    <!-- checkout section ends -->
</x-layout>
