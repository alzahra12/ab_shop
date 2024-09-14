<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        body {
            background-color: #1C2026;
        }
        .container {
            max-width: 900px; 
            margin: 0 auto;
            padding: 20px; 
        }

        h1 {
            font-size: 2rem;
            color: #fff; 
            border-bottom: 2px solid #fff; 
            padding-bottom: 10px;
            margin-bottom: 20px; 
        }

        .alert {
            padding: 15px;
            border-radius: 4px; 
            margin-bottom: 20px; 
        }

        .alert-success {
            background-color: #BF863F; 
            color: #fff; 
            border: 1px solid #c3e6cb;
        }

        .table {
            width: 100%;
            border-collapse: collapse; 
        }

        label{
            color:#fff;
        }

        .table-striped thead {
            background-color: #BF863F; 
            color: #fff;
        }

        .table-striped th, .table-striped td {
            border: 1px solid #000; 
            padding: 12px; 
            text-align: left; 
        }

        td {
            background-color:#fff;
        }

        .btn {
            padding: 10px 20px; 
            border-radius: 4px; 
            font-size: 16px; 
            text-align: center;
            cursor: pointer;
            border: none; 
            color: #ffffff; 
            transition: background-color 0.3s ease;
        }

        .btn-success {
            background-color: #BF863F; 
        }

        .btn-primary {
            background-color: #BF863F; 
        }

        .btn-primary:hover {
            background-color: #0056b3; 
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-control {
            width: 100%; 
            padding: 10px; 
            border-radius: 4px; 
            border: 1px solid #fff;
        }

        p {
            font-size: 1.2rem;
            color: #666;
        }
    </style>
</head>
<body>
<header class="header">
    <div class="container">
        <nav>
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">About</a></li>
                <li><a href="{{ route('products.index') }}">Products</a></li>
                <li><a href="{{ route('wallet.show', ['userId' => Auth::id()]) }}">Wallet</a></li>
                <li><a href="{{ route('cart.show') }}">Cart</a></li>
                <li><a href="{{ route('orders.index') }}">Orders</a></li>
            </ul>
        </nav>
    </div>
</header>

<div class="container mt-5">
    <h1>Your Cart</h1>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    
    @if($cartItems->isEmpty())
    <p>Your cart is empty.</p>
    @else
    
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cartItems as $item)
            <tr>
                <td>{{ $item->product->name }}</td>
                <td>{{ $item->quantity }}</td>
                <td>${{ $item->product->price }}</td>
                <td>${{ $item->quantity * $item->product->price }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
<br>
    <form action="{{ route('cart.add') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="product">Select Product:</label>
            <select name="product_id" class="form-control">
                @foreach($products as $product)
                <option value="{{ $product->id }}">{{ $product->name }} - ${{ $product->price }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success mt-3">Add to Cart</button>
    </form>
    <br>
    <form action="{{ route('orders.checkout') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-primary">Submit Order</button>
    </form>
</div>
<footer>
    <div class="footer-container">
        <div class="footer-section">
            <h4>About Us</h4>
            <p>We provide premium cosmetic products with a focus on quality and sustainability.</p>
        </div>
        <div class="footer-section">
            <h4>Quick Links</h4>
            <ul>
                <li><a href="{{ url('/') }}">Home</a></li>
                <li><a href="{{ url('/about') }}">About Us</a></li>
                <li><a href="{{ url('/products') }}">Products</a></li>
            </ul>
        </div>
        <div class="footer-section">
            <h4>Contact Us</h4>
            <p>Email: AB@cosmeticstore.com</p>
            <p>Phone: +968 95432111</p>
            <p>Other: +968 98432655</p>
        </div>
        <div class="footer-section">
            <h4>Follow Us</h4>
            <div class="social-icons">
                <a href="#"><img src="{{ asset('images/snapchat.png') }}" alt="snapchat"></a>
                <a href="#"><img src="{{ asset('images/twitter.png') }}" alt="twitter"></a>
                <a href="#"><img src="{{ asset('images/instagram.png') }}" alt="instagram"></a>
            </div> 
        </div>
    </div>
</footer>

</body>
</html>
