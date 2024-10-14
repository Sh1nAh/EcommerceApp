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
        color: #666;
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
    input, select
    {
        display: block;
        font-size: 1.3rem;
        color: #666;
        border: none;
        outline: none;
        font-weight: 600;
        background: #F7F9FA;
        border-radius: .5rem;
        text-transform: none;
        padding: 0 35px 0 5px;
    }
    .box
    {
        background: none;
        margin: 1rem 0;
        height: auto;
        padding: 0;
    }
</style>
<x-admin-layout>
    <section style="margin-top: 6rem;">
    <h1 class="heading" style="padding-top: 2rem; margin-bottom: 0; font-size: 2rem;">edit product</h1>        
    <div>
        <div class="orderlist">
            <form action="/admin/orders/{{ $order->id }}/update"  method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
            <table style="width: 100%; border: none; padding: 1rem 3rem 3rem 3rem; background-color: #F7F9FA; font-size: 1.3rem;">
                <tr style="height: 5rem;">
                    <th>id</th>
                    <td>{{ $order->id }}</td>
                </tr>
                <tr style="height: 5rem;">
                    <th>name</th>
                    <td>{{ $order->user->name }}</td>
                </tr>
                <tr style="height: 5rem">
                    <th>phone</th>
                    <td>{{ $order->orderDetails->first()->phone_number ?? 'N/A' }}</td>
                </tr>
                <tr style="height: 5rem;">
                    <th>email</th>
                    <td>{{ $order->user->email }}</td>
                </tr>
                <tr style="height: 5rem;">
                    <th>address</th>
                    <td>{{ $order->orderDetails->first()->address ?? 'N/A' }}</td>
                </tr>
                <tr style="height: 5rem;">
                    <th>township</th>
                    <td>{{ $order->orderDetails->first()->township ?? 'N/A' }}</td>
                </tr>
                <tr style="height: 5rem;">
                    <th>city</th>
                    <td>{{ $order->orderDetails->first()->city ?? 'N/A' }}</td>
                </tr>
                <tr style="height: 5rem;">
                    <th>items</th>
                    <td>
                        @foreach($order->orderItems as $item)
                        <div style="text-transform: none; margin: 1rem 0;">
                            {{ $item->product?->name }} ({{ $item->quantity }}) - ${{ $item->price }}
                        </div>
                        @endforeach
                    </td>
                </tr>
                <tr style="height: 5rem;">
                    <th>total amount</th>
                    <td>${{ $order->total_amount }}</td>
                </tr>
                <tr style="height: 5rem;">
                    <th>date</th>
                    <td>{{ $order->created_at }}</td>
                </tr>
                <tr style="height: 5rem;">
                    <th>status</th>
                    <td class="{{ $order->status === 'pending' ? 'text-yellow' : ($order->status == 'cancelled' ? 'text-red' : 'text-green')}}">
                        <select name="status" class="box">
                            @foreach (['pending', 'processing', 'delivered', 'cancelled'] as $status)
                                <option value="{{ $status }}" {{$order->status == $status ? 'selected' : ''}}>
                                    {{ ucfirst($status) }}
                                </option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                <tr style="height: 5rem;">
                    <td colspan="2"style="background-color: #F7F9FA; padding: 0;">
                        <button style="margin-top: 1.5rem;" class="btn1" type="submit">update</button>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</x-admin-layout>