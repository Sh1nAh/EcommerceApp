<?php

use App\Models\User;
use App\Http\Middleware\MustBeLoginUser;
use App\Http\Middleware\MustBeAdmin;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ShoppingcartController;
use App\Http\Controllers\CheckoutController;
use App\Mail\OrderShippedMail;
use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\BlogController;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\OTPController;
use App\Http\Middleware\MustBeGuest;
use App\Http\Middleware\MustBeUser;
use App\Http\Middleware\PreventAdmin;

Route::get('/otp', function () {
    return view('otp_request');
});
Route::post('/otp/send', [OTPController::class, 'send'])->name('otp.send');
Route::post('/otp/verify', [OTPController::class, 'verify'])->name('otp.verify');
Route::post('/password/email', [OTPController::class, 'sendResetOTP'])->name('password.email');
Route::post('/password/reset', [OTPController::class, 'resetPassword'])->name('password.update');

Route::get('/', [ProductController::class, 'home'])->name('home')->middleware(PreventAdmin::class);

Route::get('/locales/{locale}', function ($locale) {
    session()->put('locale', $locale);
    return redirect()->back();
});

Route::post('/login', [LoginController::class, 'store']);

Route::post('/signup', [SignupController::class, 'store']);

Route::post('/logout', [LogoutController::class, 'destroy'])->name('logout')->middleware(MustBeLoginUser::class);

Route::get('/categories/{category:slug}', [CategoryController::class, 'index'])
    ->name('categories.index');

Route::get('/products', [ProductController::class, 'index']);

Route::get('/products/{product:slug}', [ProductController::class, 'show'])->middleware(MustBeLoginUser::class);

Route::get('/add-to-cart/{product}', [ShoppingcartController::class, 'addToCart'])->name('add-to-cart')->middleware(MustBeLoginUser::class);

Route::get('/shoppingcart', [ShoppingcartController::class, 'index'])->middleware(MustBeLoginUser::class);

Route::patch('/cart-items/{id}', [ShoppingcartController::class, 'update'])->middleware(MustBeLoginUser::class);
Route::post('/cart-items/{cartitem}/delete', [ShoppingcartController::class, 'destroy'])->middleware(MustBeLoginUser::class);

Route::get('/checkout/{carts}', [CheckoutController::class, 'index'])->middleware(MustBeLoginUser::class);
// Route::get('/checkout/{order}', [CheckoutController::class, 'index'])->name('checkout.index')->middleware(MustBeLoginUser::class);

// Route::post('/checkout', [OrderController::class, 'store'])->name('checkout.store')->middleware(MustBeLoginUser::class);
// Route::post('/order/{order}/confirm', [CheckoutController::class, 'store'])->middleware(MustBeLoginUser::class);
Route::post('/order-confirm', [OrderController::class, 'store'])->name('order.confirm')->middleware(MustBeLoginUser::class);

Route::get('/send-email', function () {
    // Mail::to('kyawtnonoaung@gmail.com')->send(new OrderShippedMail);
    $users = User::pluck('email','name')->take(3);
    $users->each(function ($email, $name) {
        Mail::to($email)->queue(new OrderShippedMail($name));
    });
    return 'emails sent to all users';
})->middleware(MustBeLoginUser::class);

// Route::get('order-history', [OrderController::class, 'history'])->middleware(MustBeLoginUser::class);
Route::get('/order-history', [OrderController::class, 'history'])->middleware(MustBeLoginUser::class);


Route::get('/blog', [BlogController::class, 'index']);

Route::get('/admin', [AdminController::class, 'index'])->middleware([MustBeLoginUser::class, MustBeAdmin::class]);

Route::get('/admin/products/create', [ProductController::class, 'create'])->middleware(MustBeLoginUser::class);
Route::post('/admin/products', [ProductController::class, 'store'])->middleware(MustBeLoginUser::class);
Route::get('/admin/products', [ProductController::class, 'products'])->middleware(MustBeLoginUser::class);
Route::get('/admin/products/{product}', [ProductController::class, 'detail'])->middleware(MustBeLoginUser::class);

Route::get('/admin/products/{product}/edit', [ProductController::class, 'edit'])->middleware(MustBeLoginUser::class);
Route::put('/admin/products/{product}/update', [ProductController::class, 'update'])->middleware(MustBeLoginUser::class);
Route::delete('/admin/products/{product}/delete', [ProductController::class, 'destroy'])->middleware(MustBeLoginUser::class);

Route::get('/admin/orders', [AdminController::class, 'orders'])->middleware(MustBeLoginUser::class);
Route::get('/admin/orders/{order}', [OrderController::class, 'show'])->middleware(MustBeLoginUser::class);
Route::get('/admin/orders/{order}/edit', [OrderController::class, 'edit'])->middleware(MustBeLoginUser::class);
Route::put('/admin/orders/{order}/update', [OrderController::class, 'update'])->middleware(MustBeLoginUser::class);
Route::delete('/admin/orders/{order}/delete', [OrderController::class, 'destroy'])->middleware(MustBeLoginUser::class);