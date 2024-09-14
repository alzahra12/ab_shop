<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
<header class="header">
    <div class="container">
        <nav>
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">About</a></li>
                <li><a href="{{ route('products.index') }}">Products</a></li>
                <li><a href="{{ route('wallet.show') }}">Wallet</a></li>
                <li><a href="{{ route('cart.show') }}">Cart</a></li>
                <li><a href="{{ route('orders.index') }}">Orders</a></li>
            </ul>
        </nav>
    </div>
</header>

<section class="hero-image">
    <img src="{{ asset('images/a.jpg') }}" alt="beauty">
    <div class="hero-text">
        <h2>COSMETIC</h2>
        <p>Immerse yourself in the world of makeup and<br>
           enjoy a unique experience with our luxurious<br>
           and effective products</p>
    </div>
</section>

<section class="about-us">
        <div class="container">
            <h2>About Us</h2>
            <p>
            Welcome to our website! We are a team of makeup professionals who work hard to provide the best<br>
            services to our customers. We were established in 2024 and we pride ourselves on our expertise and<br>
            skill in makeup. Our goal is to sell products at a price that suits the customer.
            </p>
            <p>
            If you have any questions or would like to cooperate with us, please feel free to contact us.
            </p>
        </div>
</section>

<section class="features">
    <div class="container">
        <h2 class="h2">Our Top Features</h2>
        <div class="features-grid">
            <div class="feature-item">
                <img src="{{ asset('images/p6.jpg') }}" alt="p6">
                <h3>High Quality</h3>
                <p>Our products are made with the highest quality ingredients to ensure the best results.</p>
            </div>
            <div class="feature-item">
                <img src="{{ asset('images/p7.jpg') }}" alt="p7">
                <h3>Eco-Friendly</h3>
                <p>We are committed to using eco-friendly packaging and sustainable practices.</p>
            </div>
            <div class="feature-item">
                <img src="{{ asset('images/p9.jpg') }}" alt="p9">
                <h3>Affordable Prices</h3>
                <p>Get premium quality products at prices that won't break the bank.</p>
            </div>
        </div>
    </div>
</section>

<section class="features1">
    <div class="container1">
        <h2 class="h1">Our Top Products</h2>
        <div class="features-grid1">
            <div class="feature-item1">
                <img src="{{ asset('images/p1.jpg') }}" alt="p1">
                <h3>Highlighter</h3>
                <p>An innovative highlighter powder that gives your skin an immediate shine.</p>
            </div>
            <div class="feature-item1">
                <img src="{{ asset('images/p2.jpg') }}" alt="p2">
                <h3>Mascara</h3>
                <p>Used to improve the length and density of eyelashes.</p>
            </div>
            <div class="feature-item1">
                <img src="{{ asset('images/p3.jpg') }}" alt="p3">
                <h3>Lipstick</h3>
                <p>Superior gloss and attractive colors with an effect that makes lips look fuller instantly.</p>
            </div>
        </div>
    </div>
</section>

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
