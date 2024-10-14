<!-- custom css file link -->
<link rel="stylesheet" href="{{asset('css/styles.css')}}">
<style>
    .orderlist
    {
        overflow-x: auto;
    }
    tr, th, td
    {
        padding: 1rem;
        color: #333;
    }
    td
    {
        text-transform: none;
    }
    .text-yellow
    {
        color: #FDE370; 
    }
    .text-red
    {
        /* color: #E87272; */
        color: #E69397;
    }
    .text-green
    {
        color: #88CE74;
    }
    button:hover
    {
        cursor: pointer;
    }
    .product-create
    {
        margin-right: 3.2rem;
        padding: .5rem 2rem; 
        line-height: 1.5;
        font-size: 1.4rem; 
        color: #fff; 
        display: inline-block;
        font-weight: 600;
        background: #333;
        transition: .5s;
        border-radius: .5rem;
    }
    .product-create:hover
    {
        background: var(--blue);
    }
    .imagecontainer
    {
        width: 80px;
        height: 90px;
        overflow: hidden;
        border: .5rem solid #fff;
        border-radius: .5rem;
        box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .1);
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .imagecontainer img
    {
        width: 170%;
        height: 170%;
        object-fit: cover;
    }
    .new
    {
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .product-detail
    {
        font-weight: bold;
        font-size: 1.3rem;
        transition: .5s;
        color: #666;
        padding: 0 .5rem;
    }
    .product-detail:hover
    {
        color: var(--blue);
    }
    .product-edit
    {
        font-weight: bold;
        font-size: 1.3rem;
        transition: .5s;
        color: #666;
    }
    .product-edit:hover
    {
        color: var(--blue);
    }
    .product-delete
    {
        font-weight: bold;
        font-size: 1.3rem;
        transition: .5s;
        color: #666;
    }
    .product-delete:hover
    {
        color: #E87272;
    }
</style>
<x-admin-layout>
    <!-- orderlist section starts -->
    <section style="margin-top: 6rem;">
    <h1 class="heading" style="padding-top: 2rem; margin-bottom: 0; font-size: 2rem;">product list</h1>
    <div style="background: #F7F9FA; padding-bottom: 3rem;">
        <div style="text-align: right; background-color: #F7F9FA;">
            <a class="product-create" href="/admin/products/create">create</a>
        </div>
        <div class="orderlist">
            <table style="width: 100%; border: none;  padding: 1rem 3rem 3rem 3rem; background-color: #F7F9FA; font-size: 1.3rem;">
                <tr style="height: 5rem; background-color: #fff;">
                    <th>id</th>
                    <th>image</th>
                    <th>name</th>
                    <th>color</th>
                    <th>price</th>
                    <th>discount</th>
                    <th>category</th>
                    <th colspan="3">action</th>
                </tr>
                @foreach ($products as $product)
                <tr style="height: 5rem; text-align: right; background-color: #fff;">
                    <td style="text-align: center;">{{ $product->id }}</td>
                    <td class="new">
                        <div class="imagecontainer">
                            <img src="{{ $product->image }}" alt="">
                        </div>
                    </td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->color }}</td>
                    <td>${{ $product->price }}</td>
                    <td>{{ $product->discountpercentage }}%</td>
                    <td>{{ $product->category->name }}</td>
                    <td style="background: #fff; text-align: center;">
                        <a class="product-detail fas fa-info" href="/admin/products/{{ $product->id }}"></a>
                    </td>
                    <td style="text-align: center;">
                        <a href="/admin/products/{{ $product->id }}/edit" class="product-edit fas fa-edit"></a>
                    </td>
                    <td style="text-align: center;">
                        <form action="/admin/products/{{ $product->id }}/delete" method="POST">
                            @method('delete')
                            @csrf
                            <button type="submit" class="product-delete fas fa-trash"></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
        {{ $products->links() }}
    </div>
</section>
    <!-- orderlist section ends -->
</x-admin-layout>