<link rel="stylesheet" href="{{ asset('css/customstyles.css') }}">

<x-layout>
    <!-- shoppingcart section starts -->  
    <section class="shoppingcart">
        <h1 class="heading"><span>shopping </span>cart</h1>
        <div class="cart">
            @php
                $total_price = 0;
            @endphp
            @if (auth()->user()->cart?->cart_items->count())
                @foreach (auth()->user()->cart?->cart_items->load('product') as $cart_item)
                <div class="item">
                    <div class="imagecontainer">
                        <img src="{{ $cart_item->product->image }}" alt="">
                    </div>
                    <div class="info">
                        <div class="name">{{ $cart_item->product->name }}</div>
                        <div class="perproduct">${{ number_format($cart_item->product->price, 2) }}/1 product</div>
                    </div>
                    <div class="d-flex flex-row align-items-center rightside">
                        <div class="quantity">
                            <input type="number" class="quantityinput" value="{{ $cart_item->quantity }}" min="1"
                                   data-product-id="{{ $cart_item->product->id }}"
                                   data-price="{{ $cart_item->product->price }}"
                                   data-discount="{{ $cart_item->product->discountpercentage }}"
                                   onchange="updateTotal(this, {{ $cart_item->id }})">
                        </div>
                        @php
                            $product = $cart_item->product;
                            $discount_price = ($product->price / 100) * $product->discountpercentage;
                            $price = $product->price - $discount_price;
                            $total_price += $price * $cart_item->quantity; // Update total based on quantity
                        @endphp
                        <div>
                            <span class="item-price" data-quantity="{{ $cart_item->quantity }}">
                                ${{ number_format($price * $cart_item->quantity, 2) }}
                            </span>
                            @if ($product->discountpercentage > 0)
                                <span class="discount" style="color: red;">({{ $product->discountpercentage }}% off)</span>
                            @endif
                        </div>
                        <form action="/cart-items/{{ $cart_item->id }}/delete" method="POST">
                            @csrf
                            <button>
                                <i class="bin fas fa-trash-alt"></i>
                            </button>
                        </form>
                    </div>
                </div>
                @endforeach  
            @endif
            <p>Total: $<span id="totalAmount">{{ number_format($total_price, 2) }}</span></p>
            {{-- <form action="/checkout" method="POST">
                @csrf
                <input type="hidden" name="total_amount" id="hiddenTotal" value="{{ $total_price ?? 0 }}">
                <button type="submit" class="btn">checkout</button>
            </form> --}}
            <a href="/checkout/{{ auth()->user()->cart->id }}" class="btn">checkout</a>
        </div>
    </section>
    <!-- shoppingcart section ends -->

    <script>
        function updateTotal(input, cartItemId) {
            let total = 0;
            const itemPriceSpan = input.closest('.rightside').querySelector('.item-price');
            const price = parseFloat(input.getAttribute('data-price'));
            const discount = parseFloat(input.getAttribute('data-discount'));
            const discountedPrice = price - (price * (discount / 100));
            const quantity = parseInt(input.value);
    
            // Update the displayed price for this item
            const itemTotal = discountedPrice * quantity;
            itemPriceSpan.innerText = itemTotal.toFixed(2);
    
            // Recalculate overall total
            document.querySelectorAll('.quantityinput').forEach(quantityInput => {
                const price = parseFloat(quantityInput.getAttribute('data-price'));
                const discount = parseFloat(quantityInput.getAttribute('data-discount'));
                const discountedPrice = price - (price * (discount / 100));
                const quantity = parseInt(quantityInput.value);
                total += discountedPrice * quantity;
            });
    
            // Update the total amount displayed and in the hidden input
            document.getElementById('totalAmount').innerText = total.toFixed(2);
            document.getElementById('hiddenTotal').value = total.toFixed(2);
    
            // Send AJAX request to update the quantity and total in the database
            fetch(`/cart-items/${cartItemId}`, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ quantity: input.value, total_amount: total.toFixed(2) })
            })
            .then(response => response.json())
            .then(data => {
                // Optionally handle success or error messages
                console.log(data);
            })
            .catch(error => console.error('Error updating quantity:', error));
        }
    </script>
    
</x-layout>
