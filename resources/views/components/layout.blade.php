<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>E-commerce App</title>

        <!-- font awsome cdn link-->
         <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

        <!-- custom css file link -->
        <link rel="stylesheet" href="css/styles.css">

        <!-- title icon link -->
        <link rel="shortcut icon" href="images/home/title-icon.svg">
    </head>

    <body data-login-required="{{ session('login_required') ? 'true' : 'false' }}">
        <!-- header section starts -->
        <header>
            <input type="checkbox" id="toggler">
            <label for="toggler" class="fas fa-bars"></label>
            <a href="/" class="logo">phone<span>.</span></a>
            <nav class="navbar">
                <a href="/">home</a>

                @guest
                <a href="{{ route('home') }}#category">products</a>
                @else
                <a href="/products">products</a>
                @endguest

                <a href="{{ route('home') }}#contact">contact</a>
                <a href="/blog">blog</a>
            </nav>

            <div class="icons">
                <span class="fas fa-globe" id="language-btn"></span>
                <span class="fas fa-heart" id="wishlist-btn"></span>

                @auth
                <span class="fas fa-shopping-cart" id="cart-btn" 
                    @if (request()->is('shoppingcart') || request()->is('checkout/*')) style="pointer-events: none; opacity: 0.5;" @endif>
                    @if (auth()->user()->cart?->cart_items->count())
                        {{ auth()->user()->cart?->cart_items->count() }}
                    @endif
                </span>
                <span class="login-user">
                    {{ auth()->user()->name ? auth()->user()->name[0] : '' }}
                </span>
                <form action="/logout" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" style="background: none; border: none; cursor: pointer;">
                        <span class="fas fa-sign-out-alt logout-user"></span>
                    </button>
                </form>
                @else
                <span class="fas fa-user" id="login-btn"></span>
                @endauth
            </div>

            <!-- wishlist section starts -->
            {{-- <div class="wishlist">
                <div class="box">
                    <i class="fas fa-heart"></i>
                    <img src="/images/15pro/iphone15pro-blacktitanium.jpg" alt="">
                    <div class="content">
                        <h3>iPhone 15 pro</h3>
                        <span class="color">black titanium</span>
                    </div>
                </div>
                <a href="#" class="btn">remove all</a>
            </div> --}}
            <!-- wishlist section ends -->

            <!-- cart section starts -->
            <div class="shopping-cart">
                @php
                    $totalPrice = 0;
                @endphp
            
                @auth
                    @if (auth()->user()->cart?->cart_items->count())
                        @foreach (auth()->user()->cart?->cart_items->load('product') as $cart_item)
                            @php
                                $product = $cart_item->product;
                                $discountPrice = ($product->price / 100) * $product->discountpercentage;
                                $price = $product->price - $discountPrice;
                                $totalPrice += $price * $cart_item->quantity;
                            @endphp
                            <div class="box">
                                <form action="/cart-items/{{ $cart_item->id }}/delete" method="POST">
                                    @csrf
                                    <button>
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                                <img src="{{ $cart_item->product->image }}" alt="">
                                <div class="content">
                                    <h3>{{ $cart_item->product->name }}</h3>
                                    <span class="price" data-quantity="{{ $cart_item->quantity }}">
                                        ${{ number_format($price * $cart_item->quantity, 2) }}/-
                                    </span>
                                    <span class="quantity">
                                        <input type="number" class="quantityinput" value="{{ $cart_item->quantity }}" min="1"
                                               data-product-id="{{ $cart_item->product->id }}"
                                               data-price="{{ $cart_item->product->price }}"
                                               data-discount="{{ $cart_item->product->discountpercentage }}"
                                               onchange="updateTotal(this, {{ $cart_item->id }})">
                                    </span>
                                </div>
                            </div>
                        @endforeach
                        <div class="total" id="totalAmount">Total: ${{ number_format($totalPrice, 2) }}/-</div>
                        <a href="/shoppingcart" class="btn">view cart</a>
                    @else
                    <p class="empty">Your cart is empty.</p>
                    @endif
                @endauth
            </div>
            
            <script>
                function updateTotal(input, cartItemId) {
                    let total = 0;
                    const itemPriceSpan = input.closest('.content').querySelector('.price');
                    const price = parseFloat(input.getAttribute('data-price'));
                    const discount = parseFloat(input.getAttribute('data-discount'));
                    const discountedPrice = price - (price * (discount / 100));
                    const quantity = parseInt(input.value);

                    const itemTotal = discountedPrice * quantity;
                    itemPriceSpan.innerText = `$${itemTotal.toFixed(2)}/-`;

                    document.querySelectorAll('.quantityinput').forEach(quantityInput => {
                        const price = parseFloat(quantityInput.getAttribute('data-price'));
                        const discount = parseFloat(quantityInput.getAttribute('data-discount'));
                        const discountedPrice = price - (price * (discount / 100));
                        const quantity = parseInt(quantityInput.value);
                        total += discountedPrice * quantity;
                    });

                    document.getElementById('totalAmount').innerText = `Total: $${total.toFixed(2)}/-`;

                    fetch(`/cart-items/${cartItemId}`, {
                        method: 'PATCH',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ quantity: input.value })
                    })
                    .then(response => response.json())
                    .then(data => {

                        console.log(data);
                    })
                    .catch(error => console.error('Error updating quantity:', error));
                }
            </script>
            <!-- cart section ends -->

            <!-- login section starts -->
            <form action="{{ url('/login') }}" method="POST" class="login-form {{ $errors->has('user_email') || $errors->has('user_password') ? 'active' : '' }}">
                @csrf
                <span class="icon-close login-close">
                    <ion-icon name="close"></ion-icon>
                </span>
                <h3>Login</h3>        
                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="mail"></ion-icon>
                    </span>
                    <input name="user_email" type="text" required>
                    <label>Email</label>
                    <div class="error-message user_email" style="color: red;">
                        @error('user_email') {{ $message }} @enderror
                    </div>                    
                </div>
                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="lock-closed"></ion-icon>
                    </span>
                    <input name="user_password" type="password" required>
                    <label>Password</label>
                    <div class="error-message user_password" style="color: red;">
                        @error('user_password') {{ $message }} @enderror
                    </div>
                </div>
                <div class="remember-forgot">
                    <label>
                        <input name="remember" type="checkbox" value="1" {{ old('remember') ? 'checked' : '' }}> Remember me
                    </label>
                    <a href="#">Forgot password?</a>

                    <div class="error-message remember" style="color: red;">
                        @error('remember') {{ $message }} @enderror
                    </div>
                </div>
                <button id="loginnow" type="submit" class="btn1" aria-label="Login">Login</button>
                <div class="login-register">
                    <p>Don't have an account? <a href="#" class="register-link" id="signup">Register</a></p>
                </div>
            </form>
            <!-- login section ends -->
            
            <!-- signup section starts -->
            <form action="{{ url('/signup') }}" method="POST" class="signup-form {{ $errors->has('name') || $errors->has('email') || $errors->has('password') || $errors->has('password_confirmation') || $errors->has('terms') ? 'active' : '' }}">
                @csrf
                <span class="icon-close signup-close">
                    <ion-icon name="close"></ion-icon>
                </span>
                <h3>Registration</h3>
                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="person"></ion-icon>
                    </span>
                    <input name="name" type="text" value="{{ old('name') }}" required>
                    <label>Username</label>
                    <div class="error-message name" style="color: red;">
                        @error('name') {{ $message }} @enderror
                    </div>
                </div>
                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="mail"></ion-icon>
                    </span>
                    <input name="email" type="text" value="{{ old('email') }}" required>
                    <label>Email</label>
                    <div class="error-message email" style="color: red;">
                        @error('email') {{ $message }} @enderror
                    </div>
                </div>
                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="lock-closed"></ion-icon>
                    </span>
                    <input name="password" type="password" required>
                    <label>Password</label>
                    <div class="error-message password" style="color: red;">
                        @error('password') {{ $message }} @enderror
                    </div>
                </div>
                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="lock-closed"></ion-icon>
                    </span>
                    <input name="password_confirmation" type="password" required>
                    <label>Confirm Password</label>
                    <div class="error-message password_confirmation" style="color: red;">
                        @error('password_confirmation') {{ $message }} @enderror
                    </div>
                </div>
                <div class="remember-forgot">
                    <label>
                        <input type="checkbox" name="terms" required>I agree to the terms & conditions
                    </label>
                    <div class="error-message terms" style="color: red;">
                        @error('terms') {{ $message }} @enderror
                    </div>
                </div>
                <button type="submit" class="btn1" id="signupnow">Register</button>
                <div class="login-register">
                    <p>Already have an account? <a href="#" class="login-link" id="login">Login</a></p>
                </div>
            </form>
            <!-- signup section ends -->

            <!-- language section starts -->
            <div class="language">
                <div>
                    <img src="/images/eng.png" alt="">
                    <a href="/locales/en">English</a>
                </div>
                <div>
                    <img src="/images/mm.png" alt="">
                    <a href="/locales/mm">Myanmar</a>
                </div>                    
            </div>
            <!-- language section ends -->
        </header>
        <!-- header section ends -->

        <!-- Success Message Modal -->
        @if (session('success'))
        <div id="success-modal" class="modal" style="display: block;">
            <div class="modal-content">
                <span class="close" id="close-modal">&times;</span>
                <p>{{ session('success') }}</p>
            </div>
        </div>
        @endif

        <!-- error Message Modal -->
        @if (session('error'))
        <div id="success-modal" class="modal" style="display: none;">
            <div class="modal-content error">
                <span class="close error" id="close-modal">&times;</span>
                <p>{{ session('error') }}</p>
            </div>
        </div>
        @endif

{{ $slot }}

        <!-- footer section starts --> 
        <section class="footer">
            <div class="box-container">
                <div class="box">
                    <h3>quick links</h3>
                    <a href="/">home</a>
                    @auth
                    <a href="/products">products</a>
                    @else
                    <a href="{{ route('home') }}#category">products</a>
                    @endauth
                    <a href="/blog">blog</a>
                </div>
                <div class="box">
                    <h3>extra links</h3>
                    <a href="{{ route('home') }}#about">about us</a>
                    <a href="{{ route('home') }}#contact">contact us</a>
                    @auth
                    <a href="/order-history">my orders</a>
                    @endauth
                </div>      
                <div class="box">
                    <h3>locations</h3>
                    <a>yangon</a>
                    <a>mandalay</a>
                    <a>naypyitaw</a>
                </div>
                <div class="box">
                    <h3>contact info</h3>
                    <a href="tel:+959-261-859-020">+959-261-859-020</a>
                    <a>kyawtnonoaung@gmail.com</a>
                    <a>yangon, myanmar</a>
                    <span class="paybycard"><img src="{{ asset('images/home/payment.png') }}" alt=""></span>
                </div>
            </div> 
        </section>

        <div class="credit">&copy; 2024 - created by <span>shinAh</span> | all rights reserved.</div>

        <button id="toggleScroll">Back to Top</button>
        <!-- footer section ends -->

        <!-- JQuery -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

        <!-- slick carousel -->
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

        <!-- icons -->
        <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

        <!-- custom script -->
        <script src="js/app.js"></script>
    </body>
</html>