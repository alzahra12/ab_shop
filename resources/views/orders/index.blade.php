<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Orders</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        body {
            background-color: #1C2026;
        }
        .container {
            margin-top: 20px;
        }

        h1 {
            font-size: 2rem;
            color: #fff; 
            border-bottom: 2px solid #fff; 
            padding-bottom: 10px; 
            margin-bottom: 20px; 
            text-align: left;
        }

        table {
        width: 100%;
        border-collapse: collapse; 
        }

        .table-striped th, .table-striped td {
            border: 1px solid #000; 
            padding: 12px; 
            text-align: left; 
            
        }

        td {
            background-color:#fff;
        }

        th {
            background-color:#BF863F;
            color: #fff; 
        }

        .btn-custom {
            border-radius: 20px;
            font-size: 14px;
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

    <div class="container">
        <div class="page-header text-center">
            <h1>Orders List</h1>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Created At</th>
                    <th>Details</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>${{ number_format($order->total_price, 2) }}</td>
                    <td>{{ $order->status }}</td>
                    <td>{{ $order->created_at->format('Y-m-d H:i:s') }}</td>
                    <td><a href="{{ route('orders.show', $order->id) }}" class="btn btn-info btn-custom">View Details</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <br>
        <div class="text-center">
            <a href="{{ route('orders.export') }}" class="btn1">Export Orders to Excel</a>
        </div>
    </div> 
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
<br>
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

