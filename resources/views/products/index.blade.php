<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>

body{
        background-color: #1C2026;
    }
    .container {
        max-width: 1200px; 
        margin: 0 auto; 
        padding: 20px;
        border-radius: 8px; 
    }

    h1 {
        font-size: 2rem; 
        color: #fff; 
        border-bottom: 2px solid #fff; 
        padding-bottom: 10px;
        margin-bottom: 20px;
        }

    .table {
        width: 100%;
        border-collapse: collapse; 
    }

    .table-bordered th, .table-bordered td {
        border: 1px solid #000; 
        padding: 12px; 
    }

    .table-bordered th {
        background-color: #BF863F; 
        color: #ffffff; 
        font-weight: bold;
    }

    .table-bordered td {
        background-color: #ffffff; 
    }

    .table-bordered tr:hover {
        background-color: #f1f1f1;
    }

    td {
        font-size: 16px; 
    }

    th {
        font-size: 18px; 
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
    <h1>The Products</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Stock</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr>
                <td>{{ $product->name }}</td>
                <td>{{ $product->description }}</td>
                <td>${{ $product->price }}</td>
                <td>{{ $product->stock }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
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















