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
        background: #fff;
    }
    td
    {
        text-transform: none;
    }
    th
    {
        text-align: left;
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
    a,button:hover
    {
        cursor: pointer;
    }
</style>
<x-admin-layout>
    <section style="margin-top: 6rem;">
    <h1 class="heading" style="padding-top: 2rem; margin-bottom: 0; font-size: 2rem;">product details</h1>
    <div>
        <div class="orderlist">
            <table style="width: 100%; border: none; padding: 1rem 3rem 3rem 3rem; background-color: #F7F9FA; font-size: 1.3rem;">
                <tr style="height: 5rem;">
                    <th>Id</th>
                    <td>{{ $product->id }}</td>
                </tr>
                <tr style="height: 5rem;">
                    <th>Image</th>
                    <td><img src="{{ $product->image }}" alt="{{ $product->name }}" style="max-width: 150px;"/></td>
                </tr>
                <tr style="height: 5rem;">
                    <th>Name</th>
                    <td>{{ $product->name }}</td>
                </tr>
                <tr style="height: 5rem;">
                    <th>Subtext</th>
                    <td>{{ $product->subtext }}</td>
                </tr>
                <tr style="height: 5rem;">
                    <th>Color</th>
                    <td>{{ $product->color }}</td>
                </tr>
                <tr style="height: 5rem;">
                    <th>Price</th>
                    <td>${{ number_format($product->price, 2) }}</td>
                </tr>
                <tr style="height: 5rem;">
                    <th>Description</th>
                    <td>{{ $product->description }}</td>
                </tr>
                <tr style="height: 5rem;">
                    <th>Chip</th>
                    <td style="display: flex; align-items: center; gap: 1rem;">
                        <img src="{{ $product->icon1 }}" alt="Chip icon" style="max-width: 50px;"/>
                        {{ $product->icon1text }}
                    </td>
                </tr>
                <tr style="height: 5rem;">
                    <th>Camera</th>
                    <td style="display: flex; align-items: center; gap: 1rem;">
                        <img src="{{ $product->icon2 }}" alt="Camera icon" style="max-width: 50px;"/>
                        {{ $product->icon2text }}
                    </td>
                </tr>
                <tr style="height: 5rem;">
                    <th>Battery</th>
                    <td style="display: flex; align-items: center; gap: 1rem;">
                        <img src="{{ $product->icon3 }}" alt="Battery icon" style="max-width: 50px;"/>
                        {{ $product->icon3text }}
                    </td>
                </tr>
                <tr style="height: 5rem;">
                    <th>discount</th>
                    <td>
                        @if($product->discountpercentage > 0)
                            {{ $product->discountpercentage }}%
                        @else
                            <p>-</p>
                        @endif
                    </td>
                </tr>
                <tr style="height: 5rem;">
                    <th>Discount Price</th>
                    <td>
                        @if($product->discountpercentage > 0)
                            @php
                                $discount_price = ($product->price / 100) * $product->discountpercentage;
                            @endphp
                            ${{ number_format($product->price - $discount_price, 2) }}
                        @else
                            <p>-</p>
                        @endif
                    </td>
                </tr>
            </table>
            
        </div>
    </div>
    </section>
</x-admin-layout>