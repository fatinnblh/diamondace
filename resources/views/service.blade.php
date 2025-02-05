@extends('layouts.app')

@section('content')
<div class="container">
  <style>
    .service-intro {
      text-align: center;
      max-width: 900px;
      margin: 40px auto;
      padding: 20px;
    }
    
    .service-intro h2 {
      color: #003366;
      font-weight: 700;
      margin-bottom: 20px;
      font-size: 32px;
    }
    
    .service-intro p {
      font-size: 18px;
      line-height: 1.6;
      color: #333;
      margin-bottom: 30px;
      text-align: justify;
    }

    .service-heading {
      text-align: center;
      color: #003366;
      font-weight: 700;
      margin: 40px 0;
      font-size: 24px;
    }

    .services-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 30px;
      padding: 20px;
      max-width: 1200px;
      margin: 0 auto;
    }

    .service-box {
      background: #fff;
      border-radius: 8px;
      padding: 25px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
      transition: transform 0.3s ease;
      display: flex;
      flex-direction: column;
    }

    .service-box:hover {
      transform: translateY(-5px);
    }

    .service-box h3 {
      color: #003366;
      font-size: 20px;
      font-weight: 600;
      margin: 15px 0;
      text-align: center;
    }

    .service-box p {
      color: #555;
      font-size: 16px;
      line-height: 1.5;
      margin-bottom: 15px;
      text-align: justify;
    }

    .service-image {
      width: 100%;
      height: 200px;
      object-fit: cover;
      border-radius: 8px;
      margin-bottom: 15px;
    }

    .contact-button {
      display: inline-block;
      background: #25D366;
      color: white;
      padding: 10px 20px;
      border-radius: 5px;
      text-decoration: none;
      margin-top: auto;
      text-align: center;
      font-weight: 500;
      transition: background-color 0.3s ease;
    }

    .contact-button:hover {
      background: #128C7E;
      color: white;
      text-decoration: none;
    }

    .contact-button i {
      margin-right: 8px;
    }

    @media (max-width: 992px) {
      .services-grid {
        grid-template-columns: repeat(2, 1fr);
      }
    }

    @media (max-width: 576px) {
      .services-grid {
        grid-template-columns: 1fr;
      }
    }
  </style>

  <div class="service-intro">
    <h2>Service</h2>
    <p>At Diamond Ace Resources, we are more than just a thesis printing service we are your one-stop printing solution! From students to businesses and event organizers, we provide a diverse range of professional printing services designed to meet your unique needs. With our commitment to quality and customer satisfaction, we bring your ideas to life through our expert printing solutions, ensuring every project makes a lasting impression.</p>
    <h3 class="service-heading">Here's what we offer:</h3>
  </div>

  <div class="services-grid">
    <div class="service-box">
      <img src="{{ asset('images/Bunting.png') }}" alt="Bunting Printing" class="service-image">
      <h3>Bunting Printing</h3>
      <p>High-quality buntings for events, promotions, and advertising.</p>
      <a href="https://wa.me/60142230434" class="contact-button" target="_blank">
        <i class="fab fa-whatsapp"></i>Contact
      </a>
    </div>

    <div class="service-box">
      <img src="{{ asset('images/Banner.png') }}" alt="Banner Printing" class="service-image">
      <h3>Banner Printing</h3>
      <p>Large-format banners perfect for indoor and outdoor use.</p>
      <a href="https://wa.me/60142230434" class="contact-button" target="_blank">
        <i class="fab fa-whatsapp"></i>Contact
      </a>
    </div>

    <div class="service-box">
      <img src="{{ asset('images/Sticker.png') }}" alt="Label Sticker Printing" class="service-image">
      <h3>Label Sticker Printing</h3>
      <p>Custom stickers for branding, packaging, and product labels.</p>
      <a href="https://wa.me/60142230434" class="contact-button" target="_blank">
        <i class="fab fa-whatsapp"></i>Contact
      </a>
    </div>

    <div class="service-box">
      <img src="{{ asset('images/Card.png') }}" alt="Business Card Printing" class="service-image">
      <h3>Business Card Printing</h3>
      <p>Custom, professional business cards to make a lasting impression.</p>
      <a href="https://wa.me/60142230434" class="contact-button" target="_blank">
        <i class="fab fa-whatsapp"></i>Contact
      </a>
    </div>

    <div class="service-box">
      <img src="{{ asset('images/Booklet.png') }}" alt="Booklet Printing" class="service-image">
      <h3>Booklet Printing</h3>
      <p>High-quality booklets for portfolios, company profiles, and reports.</p>
      <a href="https://wa.me/60142230434" class="contact-button" target="_blank">
        <i class="fab fa-whatsapp"></i>Contact
      </a>
    </div>

    <div class="service-box">
      <img src="{{ asset('images/Poster.png') }}" alt="Poster Printing" class="service-image">
      <h3>Poster Printing</h3>
      <p>Bold, vibrant posters for marketing, education, or personal use.</p>
      <a href="https://wa.me/60142230434" class="contact-button" target="_blank">
        <i class="fab fa-whatsapp"></i>Contact
      </a>
    </div>
  </div>
</div>
@endsection
