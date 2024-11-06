<link rel="stylesheet" href="{{ asset('css/styles.css') }}">

<x-layout>
    <!-- products section starts -->
    <section class="products" id="products" style="margin: 6rem 0; min-height: 100vh">
        <h1 class="heading">{{$category->name}}.</h1>
        <form action="{{ route('categories.index', $category) }}" method="GET">
          <div class="search-container">
            <div class="select">
              <select name="tag">
                <option value="">All</option>
                @foreach ($tags as $tag)
                  <option value="{{$tag->id}}" {{ request('tag') == $tag->id ? 'selected' : '' }}>{{$tag->name}}</option>
                @endforeach
              </select>
            </div>
            <div class="search">
              <input value="{{ request('search') }}" name="search" type="text" id="search-box" placeholder="Search...">
              <button type="submit">
                <label for="search-box" class="fas fa-search"></label>
              </button>
            </div>
          </div>
        </form>

        <div class="box-container">
          @forelse ($products as $product)
            <x-product-card :product="$product"></x-product-card>
          @empty
          <div style="margin: 0 auto; text-align: center">
            <div style="width: 35rem; margin: 0 auto; overflow: hidden;">
              <img 
                style="width: 100%; object-fit: cover;"
                src="/images/home/no-product.png" alt="">
            </div>
            <p style="font-size: 1.5rem; color: #333; margin-top: 1rem">No results found.</p>
          </div>
          @endforelse
        </div>

        {{$products->links()}}
    </section>
    <!-- products section ends -->

</x-layout>

<!-- custom script -->
<script src="{{ asset('js/app.js') }}"></script>