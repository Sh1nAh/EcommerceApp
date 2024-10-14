
        <!-- custom css file link -->
        <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

<x-layout>

    <!-- detail section starts -->
    <section class="detail" id="detail">
        <h1 class="heading"> 
            <span> product </span> details 
        </h1>
        <div class="row">
            <div class="image">
                <img src="/images/15pro/iphone15pro-blacktitanium.jpg"></img>
            </div>
            <div class="description">
                <h3>{{ $product->name }}</h3>
                {{-- <p>{{ $product->subtext }}</p> --}}
                <div class="price">from $
                    @if ($product->is_discount)
                    @php
                        $discount_price = ($product->price/100) * $product->is_discount;
                    @endphp
                    {{ $product->price - $discount_price }}
                    @else
                    <span>{{ $product->price }}</span>
                    @endif
                </div>
                <p style="white-space: pre-line; margin-top: -22px;">
                    text
                </p>
                <p class="color">color:
                    <span class="colorspan">{{ $product->color }}</span>
                </p>
                <div class="icons">
                    <p>
                        <img style="height: 3.5rem;" src="/images/15pro/iphone15pro-icon1.jpg" alt=""><br>
                        <span style="white-space: pre-line;">text</span>
                    </p>
                    <p>
                        <img style="height: 3.5rem;" src="/images/15pro/iphone15pro-icon2.jpg" alt=""><br>
                        <span style="white-space: pre-line;">text</span>
                    </p>
                    <p>
                        <img style="height: 2.5rem; margin-top: 0.5rem; margin-bottom: 0.5rem;" src="/images/15pro/iphone15pro-icon3.jpg" alt=""><br>
                        <span style="white-space: pre-line;">text</span>
                    </p>
                </div>
                <a href="/products/{{ $product->id }}" class="btn cartdetail">keep shopping</a>
                <form action="/add-to-cart/{{ $product->id }}" method="POST">
                    @csrf
                    <button type="submit" class="btn cartdetail">add to cart</button>
                </form>
            </div>
        </div>
     </section>
    <!-- detail section ends -->

</x-layout>

<!-- custom script -->
<script src="{{ asset('js/app.js') }}"></script>
