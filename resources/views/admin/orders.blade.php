<!-- custom css file link -->
<link rel="stylesheet" href="{{asset('css/styles.css')}}">
<style>
    .orderlist
    {
        overflow-x: auto;
        scrollbar-color: #333 #fff;
    }
    .orderlist:hover
    {
        scrollbar-color: #666 #fff;
    }
    .orderlist::-webkit-scrollbar {
        padding: 0 3rem;
    }
    .orderlist::-webkit-scrollbar-track {
        background: #fff;
    }

    .orderlist::-webkit-scrollbar-thumb {
        background: #333;
        border-radius: .5rem;
    }

    .orderlist::-webkit-scrollbar-thumb:hover {
        background: #666;
    }
    tr, th, td
    {
        padding: 1rem;
        color: #333;
    }
    td
    {
        white-space: nowrap;
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
    .order-detail
    {
        font-weight: bold;
        font-size: 1.3rem;
        transition: .5s;
        color: #333;
        background: none;
        padding: 0 .5rem;
    }
    .order-detail:hover
    {
        color: var(--blue);
    }
    .order-edit
    {
        font-weight: bold;
        font-size: 1.3rem;
        transition: .5s;
        color: #333;
        background: none;
    }
    .order-edit:hover
    {
        color: var(--blue);
    }
    .order-delete
    {
        font-weight: bold;
        font-size: 1.3rem;
        transition: .5s;
        color: #333;
        background: none;
    }
    .order-delete:hover
    {
        color: #E87272;
    }
</style>
<x-admin-layout>
    <!-- orderlist section starts -->
    <section style="margin-top: 6rem;">
    <h1 class="heading" style="padding-top: 2rem; margin-bottom: 0; font-size: 2rem;">orders</h1>
    <div style="background: #F7F9FA; padding: 0 3rem 2rem 3rem;">
        <div class="orderlist">
            <table style="width: 100%; border: none; padding-top: 1rem; background-color: #F7F9FA; font-size: 1.3rem;">
                <tr style="height: 5rem; background-color: #fff;">
                    <th>id</th>
                    <th>name</th>
                    <th>total amount</th>
                    <th>date</th>
                    <th>status</th>
                    <th colspan="3">action</th>
                </tr>
                @foreach ($orders as $order)
                <tr style="height: 5rem; text-align: right; background-color: #fff;">
                    <td style="text-align: center;">{{ $order->id }}</td>
                    <td>{{ $order->user->name }}</td>
                    <td>${{ $order->total_amount }}</td>
                    <td>{{ $order->created_at }}</td>
                    <td class="{{ 
                        $order->status === 'pending' ? 'text-yellow' : 
                        ($order->status === 'processing' ? 'text-blue' : 
                        ($order->status === 'cancelled' ? 'text-red' : 'text-green')) 
                    }}">
                        {{ $order->status }}
                    </td>
                    <td style="background: #fff; text-align: center;">
                        <a class="order-detail fas fa-info" href="/admin/orders/{{ $order->id }}"></a>
                    </td>
                    <td style="text-align: center;">
                        <a href="/admin/orders/{{ $order->id }}/edit" class="order-edit fas fa-edit"></a>
                    </td>
                    <td style="text-align: center;">
                        <form action="/admin/orders/{{ $order->id }}/delete" method="POST">
                            @method('delete')
                            @csrf
                            <button type="submit" class="order-delete fas fa-trash"></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
        <div style="padding: 4rem 0 2rem;">
            {{ $orders->links() }}
        </div>
    </div>
</section>
    <!-- orderlist section ends -->
</x-admin-layout>