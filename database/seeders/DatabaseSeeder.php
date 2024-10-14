<?php

// namespace Database\Seeders;

// use App\Models\Blog;
// use App\Models\Cart;
// use App\Models\CartItem;
// use App\Models\User;
// use App\Models\Category;
// use App\Models\Product;
// use App\Models\Order;
// use App\Models\OrderItem;
// use App\Models\OrderDetail;
// use App\Models\Tag;
// use Illuminate\Support\Facades\Hash;
// use Illuminate\Database\Seeder;

// class DatabaseSeeder extends Seeder
// {
//     /**
//      * Seed the application's database.
//      */
//     public function run(): void
//     {
//         $tags = Tag::factory()->count(3)->create();

//         Category::factory(5)
//             ->has(Product::factory()->count(10))
//             ->afterCreating(function (Category $category) use ($tags) {
//                 $products = $category->products;
//                 $chunks = $products->chunk(3);
//                 foreach ($tags as $index => $tag) {
//                     $chunk = $chunks->get($index);
//                     $tag->products()->attach($chunk);
//                 }

//                 // Get the remaining products
//                 $remainingProducts = $products->skip($tags->count() * 3);

//                 // If there are remaining products, assign a random tag to each
//                 if ($remainingProducts->count() > 0) {
//                     $remainingProducts->each(function ($product) use ($tags) {
//                         $randomTag = $tags->random();
//                         $randomTag->products()->attach($product);
//                     });
//                 }
//             })
//             ->create();

//             if (User::where('email', 'kyawtnonoaung@gmail.com')->doesntExist()) {
//                 User::create([
//                     'name' => 'Admin',
//                     'email' => 'kyawtnonoaung@gmail.com',
//                     'password' => Hash::make('Sh1nAh'),
//                     'role' => 'admin',
//                 ]);
//             }

//         // Create Users with Carts and Orders
//         User::factory(3)
//             ->has(Cart::factory()->count(1))
//             ->has(Order::factory()
//                 ->has(OrderItem::factory()->count(3))
//                 ->count(3)
//                 ->afterCreating(function (Order $order) {
//                     // Create an OrderDetail for each created Order
//                     OrderDetail::factory()->create(['order_id' => $order->id]);
//                 })
//             )
//             ->create();

//         // Create a test user
//         User::factory()->create([
//             'name' => 'Test User',
//             'email' => 'test@example.com',
//             'password' => bcrypt('password123'),
//             'role' => 'user',
//         ]);

//         User::create([
//             'name' => 'Admin',
//             'email' => 'kyawtnonoaung@gmail.com',
//             'password' => Hash::make('Sh1nAh'),
//             'role' => 'admin', // Set the role to admin
//         ]);

//         // Create blog entries
//         Blog::factory(20)->create();

//         // Populate carts with cart items
//         $carts = Cart::all();
//         $carts->each(function ($cart) {
//             CartItem::factory(5)->create(['cart_id' => $cart->id]);
//         });
//     }
// }

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderDetail;
use App\Models\Tag;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create tags
        $tags = Tag::factory()->count(3)->create();

        // Create categories with products and attach tags
        Category::factory(5)
            ->has(Product::factory()->count(10))
            ->afterCreating(function (Category $category) use ($tags) {
                $products = $category->products;
                $chunks = $products->chunk(3);
                foreach ($tags as $index => $tag) {
                    $chunk = $chunks->get($index);
                    $tag->products()->attach($chunk);
                }

                // Attach remaining products to random tags
                $remainingProducts = $products->skip($tags->count() * 3);
                if ($remainingProducts->count() > 0) {
                    $remainingProducts->each(function ($product) use ($tags) {
                        $randomTag = $tags->random();
                        $randomTag->products()->attach($product);
                    });
                }
            })
            ->create();

        // Create the admin user using the factory method
        if (User::where('email', 'kyawtnonoaung@gmail.com')->doesntExist()) {
            User::factory()->admin()->create([
                'name' => 'Admin',
                'email' => 'kyawtnonoaung@gmail.com', // Ensure unique email
                'password' => Hash::make('Sh1nAh'), // Set password
            ]);
        }

        User::factory(3)
            ->has(Cart::factory()->count(1))
            ->has(Order::factory()
                ->has(OrderItem::factory()->count(3))
                ->count(3)
                ->afterCreating(function (Order $order) {
                    // Create an OrderDetail for each created Order
                    OrderDetail::factory()->create(['order_id' => $order->id]);
                })
            )
            ->create();

        // Create blog entries
        Blog::factory(20)->create();

        // Populate carts with cart items
        $carts = Cart::all();
        $carts->each(function ($cart) {
            CartItem::factory(5)->create(['cart_id' => $cart->id]);
        });
    }
}
