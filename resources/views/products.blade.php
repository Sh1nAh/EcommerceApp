
<x-layout>
  @if(session('login_required'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Show the login form
            document.querySelector('.login-form').classList.add('active');
        });
    </script>
  @endif

    <!-- products section starts -->
    <section class="products" id="products" style="margin-top: 6rem; min-height: 100vh">
        <h1 class="heading"> {{__('messages.latest')}} <span>{{__('messages.products')}}</span></h1>
        <form action="/products">
            <div class="search-container">
              <div class="select">
                <select name="tag" id="">
                  <option value="">All</option>
                  @foreach ($tags as $tag)
                    <option value="{{$tag->id}}" {{request('tag') == $tag->id ? 'selected' : ''}}>{{$tag->name}}</option>
                  @endforeach
                </select>
              </div>
              <div class="search">
                <input value="{{request('search')}}" name="search" type="text" id="search-box" placeholder="Search...">
                <button type="submit">
                  <label for="search-box" class="fas fa-search"></label>
                </button>
              </div>
            </div>
        </form>
        <div class="box-container">
          {{-- @forelse ($products->load('category') as $product) --}}
          @forelse ($products as $product)
            <x-product-card :product="$product"></x-product-card>
          @empty
          <div style="margin: 0 auto; text-align: center">
            <div style="width: 35rem; margin: 0 auto; overflow: hidden;">
              <img 
                style="width: 100%; object-fit: cover;"
                src="/images/home/no-product.png" alt="">
            </div>
            <p style="font-size: 1.5rem; color: #333; margin-top: 1rem">no results found.</p>
          </div>
          @endforelse
            
        </div>
        {{$products->links()}}
    </section>
    <!-- products section ends -->

</x-layout>