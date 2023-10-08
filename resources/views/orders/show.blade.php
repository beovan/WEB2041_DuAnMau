@extends('main')
{{--// Assuming you have a layout template, adjust this line as needed--}}
@section('content')
    <h1>Order Details</h1>
    <p>Order ID: {{ $order->id }}</p>
    <p>Order Date: {{ $order->created_at }}</p>
    <p>Total Amount: ${{ $order->total_amount }}</p>

    <h2>Order Items</h2>
    <table>
        <thead>
        <tr>
            <th>Product Name</th>
            <th>Quantity</th>
            <th>Price</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($orderItems as $item)
            <tr>
                <td>{{ $item->product->name }}</td>
                <td>{{ $item->quantity }}</td>
                <td>${{ $item->price }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <a href="{{ route('orders.index') }}">Back to Orders</a>
@endsection
