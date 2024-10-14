<x-layout>
    <div style="padding: 2rem;">
        <h1 style="color: #333; font-size: 3rem;">Order List</h1>
    </div>
    <div style="padding: 1rem 4rem;">
        <div class="orderlist">
            <table style="width: 100%; border: none;">
                <tr style="height: 5rem; background-color: var(--blue);">
                    <th>Order ID</th>
                    <th>Items</th>
                    <th>Total Amount</th>
                    <th>Date</th>
                    <th>Status</th>
                </tr>
                @foreach ($orders as $order)
                <tr style="height: 5rem; text-align: right;">
                    <td>{{ $order->id }}</td>
                    <td>
                        @foreach($order->orderItems as $item)
                            {{ $item->product->name }} ({{ $item->quantity }}) <br>
                        @endforeach
                    </td>
                    <td>${{ $order->total_amount }}</td>
                    <td>{{ $order->created_at->format('Y-m-d H:i') }}</td>
                    <td class="{{ $order->status === 'pending' ? 'text-yellow' : ($order->status === 'cancelled' ? 'text-red' : 'text-green') }}">{{ ucfirst($order->status) }}</td>
                </tr>
                @endforeach
            </table>
        </div>
        {{ $orders->links() }} <!-- Pagination links -->
    </div>
</x-layout>
