<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details - Order #{{ $order->id }}</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        body {
            background-color: #1C2026;
        }
        .container {
            margin-top: 30px;
        }

        h1 {
            font-size: 2rem;
            color: #fff; 
            padding-bottom: 10px; 
            margin-bottom: 20px; 
            background-color: #BF863F;
        }
        
        .card-body {
            background-color: white;
            min-height: 100px;
            text-align: center;
        }

        .btn1 {
            padding: 10px 20px; 
            border-radius: 4px; 
            font-size: 16px; 
            text-align: center; 
            cursor: pointer; 
            border: none; 
            color: #ffffff;
            background-color: #BF863F;
        }

    </style>
</head>
<body>
<header class="header">
    <div class="container">
        <nav>
            <ul>
                <li><a href="{{ route('home.index') }}">Home</a></li>
                <li><a href="#">About</a></li>
                <li><a href="{{ route('products.index') }}">Products</a></li>
                <li><a href="{{ route('wallet.show', ['userId' => Auth::id()]) }}">Wallet</a></li>
                <li><a href="{{ route('cart.show') }}">Cart</a></li>
                <li><a href="{{ route('orders.index') }}">Orders</a></li>
            </ul>
        </nav>
    </div>
</header>
<br>
    <div class="container">
        <div class="card">
            <div class="card-header text-center">
                <h1>Order Details - Order #{{ $order->id }}</h1>
            </div>
            <div class="card-body">
                <br>
                <p><strong>Total:</strong> ${{ number_format($order->total_price, 2) }}</p>
                <p><strong>Status:</strong> {{ $order->status }}</p>
                <p><strong>Created At:</strong> {{ $order->created_at->format('Y-m-d H:i:s') }}</p>

                <ul class="list-group">
                    @foreach ($order->items as $item)
                    <li class="list-group-item">
                        {{ $item->product->name }}: {{ $item->quantity }} x ${{ number_format($item->price, 2) }}
                    </li>
                    @endforeach
                </ul>

                <br><br>

                <div>
                    <a href="{{ route('orders.index') }}" class="btn1">Back to Orders List</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>

    <br><br><br>

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
