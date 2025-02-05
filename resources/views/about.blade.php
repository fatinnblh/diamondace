@extends('layouts.app')

@section('content')
<style>
  .welcome-container {
    gap: 20px;
    display: flex;
  }
  .image-column {
    display: flex;
    flex-direction: column;
    line-height: normal;
    width: 26%;
    margin-left: 0;
  }
  .welcome-image {
    aspect-ratio: 0.9;
    object-fit: contain;
    object-position: center;
    width: 550px;
    margin-top: 11px;
    max-width: 100%;
  }
  .content-column {
    display: flex;
    flex-direction: column;
    line-height: normal;
    width: 74%;
    margin-left: 20px;
  }
  .welcome-text {
    color: #000;
    text-align: justify;
    text-transform: capitalize;
    font: 500 18px/26px Inter, sans-serif;
  }
  @media (max-width: 991px) {
    .welcome-container {
      flex-direction: column;
      align-items: stretch;
      gap: 0;
    }
    .image-column {
      width: 100%;
    }
    .welcome-image {
      margin-top: 40px;
    }
    .content-column {
      width: 100%;
    }
    .welcome-text {
      max-width: 100%;
      margin-top: 40px;
    }
  }
  .why-choose-us {
    text-align: center;
    margin-top: 40px;
  }
  .section-title {
    font-size: 24px;
    margin-bottom: 20px;
  }
  .features-container {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: 20px;
  }
  .feature-box {
    flex: 1 1 calc(33.333% - 40px); /* Three boxes per line */
    max-width: calc(33.333% - 40px);
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    background-color: #f8f9fa;
    border: 1px solid #dee2e6;
    border-radius: 5px;
    padding: 15px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }
  .feature-box-header {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    margin-bottom: 10px;
  }
  .feature-box-header i {
    font-size: 28px;
    margin-right: 10px;
  }
  .feature-box-header strong {
    border-right: none;
    padding-right: 0;
    color: #003366; /* Dark blue color */
  }
  .feature-box:hover {
    transform: translateY(-5px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
  }
  @media (max-width: 768px) {
    .feature-box {
      flex: 1 1 100%;
      max-width: 100%;
    }
  }
  .container {
    width: 100%;
    max-width: 100%;
    padding: 0 20px;
  }
  .map-container {
    margin-top: 40px;
    display: flex;
    justify-content: center;
  }
  .section-divider {
    margin: 40px 0;
    border: 0;
    border-top: 8px solid #000; /* Thicker and darker line */
  }
  .contact-section {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    align-items: flex-start;
    gap: 40px;
    padding: 20px;
  }
  .contact-info {
    flex: 1;
    padding-left: 40px;
    text-align: left;
  }
  .map-container {
    flex: 2;
  }
  .info-block {
    margin-bottom: 30px;
  }
  .info-block h3 {
    color: #003366;
    margin-bottom: 10px;
    font-size: 24px;
    text-align: left;
  }
  .info-block p {
    font-size: 18px;
    line-height: 1.6;
    margin: 0;
    text-align: left;
  }
  @media (max-width: 768px) {
    .contact-section {
      flex-direction: column;
    }
    .contact-info {
      width: 100%;
      padding-left: 0;
    }
    .map-container {
      width: 100%;
    }
  }
</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-k6RqeWeci5ZR/Lv4MR0sA0FfDOM5o2x9s0r3jzlpjq2v1z+8abtTE1Pi6jizoU6L" crossorigin="anonymous">

<div class="container">
  <div class="welcome-container">
    <div class="image-column">
      <img
        loading="lazy"
        src="{{ asset('images/kedai.jpeg') }}"
        class="welcome-image"
        alt="Diamond Ace Thesis Printing Services"
      />
    </div>
    <div class="content-column">
      <div class="welcome-text">
        Welcome to Diamond Ace Thesis Printing, your trusted partner for
        professional thesis printing and binding services. We understand the
        importance of presenting your hard work in the best possible way, and
        our mission is to provide high-quality printing solutions tailored to
        your needs.
        <br />
        <br />
        At Diamond Ace, we specialize in thesis printing and binding for
        final-year students, ensuring every document meets university standards.
        Our platform offers a seamless online ordering experience, allowing you
        to customize your thesis covers, choose binding options, and receive
        your printed copies with ease.
      </div>
    </div>
  </div>
  <h2 style="text-align: center; font-weight: 700; margin: 40px 0;">Why Choose Us?</h2>
  <div class="features-container">
    <div class="feature-box">
      <div class="feature-box-header">
        <i class="fas fa-print"></i>
        <strong> |  High-Quality Printing</strong>
      </div>
      <p>We use premium materials to ensure clear, crisp prints and durable binding.</p>
    </div>
    <div class="feature-box">
      <div class="feature-box-header">
        <i class="fas fa-book"></i>
        <strong> |  Custom Binding Options</strong>
      </div>
      <p>Choose from a variety of covers, binding styles, and finishes to match your preferences.</p>
    </div>
    <div class="feature-box">
      <div class="feature-box-header">
        <i class="fas fa-clock"></i>
        <strong> |  Fast & Reliable Service</strong>
      </div>
      <p>Submit your order online and get your thesis printed efficiently.</p>
    </div>
    <div class="feature-box">
      <div class="feature-box-header">
        <i class="fas fa-laptop"></i>
        <strong> |  User-Friendly Platform</strong>
      </div>
      <p>Our intuitive system makes it easy to upload, preview, and track your order.</p>
    </div>
    <div class="feature-box">
      <div class="feature-box-header">
        <i class="fas fa-dollar-sign"></i>
        <strong> |  Affordable Pricing</strong>
      </div>
      <p>Our pricing is competitive and transparent, ensuring you get the best value for your money.</p>
    </div>
    <div class="feature-box">
      <div class="feature-box-header">
        <i class="fas fa-lock"></i>
        <strong> |  Secure & Confidential</strong>
      </div>
      <p>We prioritize your privacy and ensure that your thesis remains protected and confidential.</p>
    </div>
  </div>
  <hr class="section-divider">
  <div class="contact-section">
    <div class="map-container">
      <iframe
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3977.598280682734!2d101.5271884!3d3.6846506!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31cb880ba4cc7dbd:0x9ae23187274cc6f2!2sPusat+Latihan+Memandu+Wawasan+-+Cawangan+Taman+Universiti!5e0!3m2!1sen!2smy!4v1632928383435!5m2!1sen!2smy"
        width="600"
        height="450"
        style="border:0;"
        allowfullscreen=""
        loading="lazy"
        referrerpolicy="no-referrer-when-downgrade"
      ></iframe>
    </div>
    <div class="contact-info">
      <div class="info-block">
        <h3>ADDRESS</h3>
        <p>No. 26 Jalan U1/1, Taman Universiti<br>
        35900 Tanjong Malim Perak</p>
      </div>
      <div class="info-block">
        <h3>CONTACT US</h3>
        <p>+6014-2230434 (En. Khairul)</p>
      </div>
    </div>
  </div>
</div>
@endsection
