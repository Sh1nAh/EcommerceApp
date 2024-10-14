<div class="box">
    @if ($product->discountpercentage)
        <span class="discount">{{ $product->discountpercentage }}%</span>
    @endif
    <div class="image">
        <img src="{{ $product->image }}" alt="">
        <div class="icons">
            <a href="#" class="fas fa-heart"></a>
            <a href="/products/{{ $product->slug }}" class="cart-btn">detail</a>
            <a href="{{ route('add-to-cart', $product->id) }}" class="fas fa-shopping-cart"></a>
            {{-- <form action="{{ route('add-to-cart', $product->id) }}" method="POST" style="display: inline;">
                @csrf
                <button class="fas fa-shopping-cart cart-btn" type="submit"></button>
            </form> --}}
        </div>
    </div>
    <div class="content">
        <h3>{{ $product->name }}</h3>
        <p>{{ $product->color }}</p>
        <div class="price">
            @php
                $discount_price = ($product->price / 100) * $product->discountpercentage;
            @endphp
            ${{ number_format($product->price - $discount_price, 2) }}

            @if ($product->discountpercentage)
                <span>${{ number_format($product->price, 2) }}</span>
            @endif
        </div>
    </div>
</div>