<h1>List of Orders</h1>
<table>
    <thead>
    <tr>
        <th>Order ID</th>
        <th>Order Date</th>
        <th>Total Amount</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>

    @foreach ($orders as $order)
        <tr>
            <td>{{ $order->id }}</td>
            <td>{{ $order->order_date }}</td>
            <td>${{ $order->total_amount }}</td>
            <td><a href="{{ route('orders.show', $order->id) }}">View Details</a></td>
        </tr>
    @endforeach

    </tbody>
</table>
