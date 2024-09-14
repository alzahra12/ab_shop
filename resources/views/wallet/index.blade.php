<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wallet</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
 
    <style>
        body {
            background-color: #1C2026;
        }

        h1 {
            font-size: 2rem;
            color: #fff; 
            border-bottom: 2px solid #fff;
            padding-bottom: 10px;
            margin-bottom: 20px;
            text-align:left;
        }
        
        .card-body {
            background-color: white;
        }
        .btn-custom {
            border-radius: 20px;
            font-size: 16px;
        }
        .input-group input {
            border-radius: 20px 0 0 20px;
            width: 83%;
            border: 2px solid #000;
        }

        .input-group button {
            border-radius: 0 20px 20px 0;
            background-color: #BF863F;
        }
        .form-container {
            max-width: 600px;
            margin: 0 auto;
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

<br><br>

<div class="container mt-5">
    <div class="form-container">
        <div class="card">
<div class="card-header text-center">
    <h1>Your Wallet</h1>
</div>
<div class="card-body p-4">
    <h3>Balance: <span id="balance">Loading...</span></h3><br>
    <div class="input-group mb-4">
        <input type="number" id="addAmount" class="form-control" placeholder="Enter amount to add" required>
        <button onclick="addToWallet(document.getElementById('addAmount').value)" class="btn btn-success btn-custom">Add Funds</button>
    </div>
    <br>
    <div class="input-group">
        <input type="number" id="deductAmount" step="0.01" class="form-control" placeholder="Enter amount to deduct" required>
        <button onclick="deleteFromWallet(document.getElementById('deductAmount').value)" class="btn btn-danger btn-custom">Deduct Funds</button>
    </div>
    <br>
</div>
</div>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
   function addToWallet(amount) {
       axios.post('/wallet/add', {
           amount: amount
       })
       .then(response => {
           document.getElementById('balance').innerText = response.data.new_balance; 
           Swal.fire({
               icon: 'success',
               title: 'Add Successflly',
               timer: 5000, 
               showConfirmButton: false
           });
       })
       .catch(error => {
           console.error('There was an error adding to the wallet!', error);
       });
   }
   function deleteFromWallet(amount) {
       axios.post('/wallet/deduct', {
           amount: amount
       })
       .then(response => {
           document.getElementById('balance').innerText = response.data.new_balance; 
           Swal.fire({
               icon: 'success',
               title: 'Delete Successflly',
               timer: 5000, 
               showConfirmButton: false
           });
       })
       .catch(error => {
           console.error('There was an error deleting from the wallet!', error);
       });
   }
</script>
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

@if(session('success'))
<div class="alert alert-success">
       {{ session('success') }}
</div>
@endif
@if(session('error'))
<div class="alert alert-danger">
       {{ session('error') }}
</div>
@endif

</body>
</html>
