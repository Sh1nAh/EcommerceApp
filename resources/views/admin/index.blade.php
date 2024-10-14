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
    .text-blue
    {
        color: var(--blue);
    }
    a,button:hover
    {
        cursor: pointer;
    }
</style>
<x-admin-layout>
    <section style="margin-top: 6rem;">
    <!-- dashboard section starts -->
    <h1 class="heading" style="padding-top: 2rem;margin-bottom: 0; font-size: 2rem;">recent orders</h1>
    <div>
        <div class="orderlist">
            <table style="width: 100%; border: none; padding: 1rem 3rem 3rem 3rem; background-color: #F7F9FA; font-size: 1.3rem;">
                <tr style="height: 5rem; background-color: #fff;">
                    <th>id</th>
                    <th>name</th>
                    <th>phone</th>
                    <th>total</th>
                    <th>status</th>
                </tr>
                @foreach ($orders as $order)
                <tr style="height: 5rem; text-align: right; background-color: #fff;">
                    <td style="text-align: center;">{{ $order->id }}</td>
                    <td>{{ $order->user->name }}</td>
                    <td>{{ $order->orderDetails->first()->phone_number ?? 'N/A' }}</td> <!-- Use null coalescing -->
                    <td>${{ number_format($order->total_amount, 2) }}</td> <!-- Format amount -->
                    <td class="{{ 
                        $order->status === 'pending' ? 'text-yellow' : 
                        ($order->status === 'processing' ? 'text-blue' : 
                        ($order->status === 'cancelled' ? 'text-red' : 'text-green')) 
                    }}">
                        {{ $order->status }}
                    </td>
                </tr>
            @endforeach
            </table>
        </div>
        {{ $orders->links() }}
    </div>
</section>
    <!-- dashboard section ends -->
</x-admin-layout>