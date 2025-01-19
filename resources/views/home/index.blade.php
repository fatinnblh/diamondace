<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AceThesis@U - Home</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    
</head>
<body>
    <!-- Header -->
    <header>
        <nav>
            <ul>
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Blog</a></li>
                <li><a href="#">Service</a></li>
                <li><a href="#">Contact Us</a></li>
                <li><a href="{{ route('login') }}">Login</a></li>
            </ul>
        </nav>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h1>Streamline Your <span>Thesis Printing Process</span></h1>
            <p>Providing high-quality thesis printing services tailored to your needs...</p>
            @auth
                <a href="{{ route('orders.create') }}" class="btn-order">Order Thesis</a>
            @else
                <a href="{{ route('login') }}" class="btn-order">Order Thesis</a>
            @endauth
        </div>
    </section>

    <!-- How You Can Order Section -->
    <section class="steps">
        <h2>How You Can Order</h2>
        <div class="step-icons">
            <div class="step">
                <img src="{{ asset('images/customization.jpg') }}" alt="Customization">
                <p>Customization</p>
            </div>
            <div class="step">
                <img src="{{ asset('images/upload.jpg') }}" alt="Upload">
                <p>Upload</p>
            </div>
            <div class="step">
                <img src="{{ asset('images/review details.jpg') }}" alt="Review Details">
                <p>Review Details</p>
            </div>
            <div class="step">
                <img src="{{ asset('images/Payment Method.jpg') }}" alt="Payment Method">
                <p>Payment Method</p>
            </div>
            <div class="step">
                <img src="{{ asset('images/submit order.jpg') }}" alt="Submit Order">
                <p>Submit Order</p>
            </div>
            <div class="step">
                <img src="{{ asset('images/track order.jpg') }}" alt="Track Order">
                <p>Track Order</p>
            </div>
            <div class="step">
                <img src="{{ asset('images/delivery-icon.png') }}" alt="Delivery/Pickup">
                <p>Delivery/Pickup</p>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <p>&copy; {{ date('Y') }} AceThesis@U. All rights reserved.</p>
    </footer>

    <!-- Optional: Include JS files -->
</body>
</html>
<style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            background-color: #f4f4f8;
        }

        header nav ul {
            display: flex;
            justify-content: center;
            list-style: none;
            padding: 1rem 0;
            background-color: #fff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        header nav ul li {
            margin: 0 15px;
        }

        header nav ul li a {
            text-decoration: none;
            color: #333;
            font-weight: bold;
        }

        .hero {
            text-align: center;
            padding: 50px 20px;
            background-color: #eef2fa;
        }

        .hero h1 {
            font-size: 2rem;
        }

        .hero .btn-order {
            padding: 10px 20px;
            background-color: #3498db;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        .steps {
            padding: 20px;
            text-align: center;
        }

        .step-icons {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
        }

        .step {
            margin: 15px;
            text-align: center;
        }

        .step img {
            max-width: 100px;
            height: auto;
        }

        footer {
            background: #35424a;
            color: #ffffff;
            text-align: center;
            padding: 20px 0;
        }
    </style>