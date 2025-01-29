@extends('layouts.app')

@section('content')
<style>
.thesis-container {
  gap: 20px;
  display: flex;
}

.image-column {
  display: flex;
  flex-direction: column;
  line-height: normal;
  width: 50%;
  margin-left: 0;
}

.thesis-image {
  aspect-ratio: 1.08;
  object-fit: contain;
  object-position: center;
  width: 100%;
  flex-grow: 1;
}

.content-column {
  display: flex;
  flex-direction: column;
  line-height: normal;
  width: 50%;
  margin-left: 20px;
}

.content-wrapper {
  z-index: 10;
  display: flex;
  flex-direction: column;
  font-family: Inter, sans-serif;
}

.heading-primary {
  color: var(--Main-color, #0a2472);
  font-size: 48px;
  font-weight: 700;
  line-height: 72px;
  text-transform: capitalize;
}

.highlight-text {
  color: rgba(10, 36, 114, 1);
}

.description-text {
  color: #000;
  text-align: justify;
  font-size: 22px;
  font-weight: 400;
  line-height: 24px;
  margin: 41px 26px 0 0;
}

@media (max-width: 991px) {
  .thesis-container {
    flex-direction: column;
    align-items: stretch;
    gap: 0;
  }

  .image-column {
    width: 100%;
  }

  .thesis-image {
    max-width: 100%;
    margin-top: 40px;
  }

  .content-column {
    width: 100%;
  }

  .content-wrapper {
    max-width: 100%;
    margin: 40px -16px 0 0;
  }

  .heading-primary {
    max-width: 100%;
    font-size: 40px;
    line-height: 67px;
  }

  .description-text {
    max-width: 100%;
    margin: 40px 10px 0 0;
  }
}

/* Existing styles for steps section */
.steps {
    padding: 3rem;
    text-align: center;
    background: linear-gradient(to bottom, #ffffff, #f8f9ff);
    margin-top: 4rem;
}

.steps h2 {
    margin-bottom: 3rem;
    color: #0a2472;
    font-size: 36px;
    font-weight: 700;
    position: relative;
    display: inline-block;
    padding-bottom: 12px;
}

.steps h2::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 60%;
    height: 3px;
    background: #0a2472;
    border-radius: 2px;
}

.step-icons {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: 2.5rem;
    padding: 20px;
    max-width: 1400px;
    margin: 0 auto;
}

.step {
    flex: 1;
    min-width: 200px;
    max-width: 250px;
    padding: 35px;
    border-radius: 20px;
    background: white;
    box-shadow: 0 4px 15px rgba(10, 36, 114, 0.1);
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    overflow: hidden;
    animation: fadeInUp 0.5s ease backwards;
}

.step::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, rgba(10, 36, 114, 0.1), rgba(65, 105, 225, 0.1));
    opacity: 0;
    transition: opacity 0.4s ease;
}

.step:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 30px rgba(10, 36, 114, 0.15);
}

.step:hover::before {
    opacity: 1;
}

.step img {
    width: 100px;
    height: 100px;
    margin-bottom: 1.5rem;
    border-radius: 15px;
    padding: 15px;
    background: #f8f9ff;
    transition: all 0.4s ease;
    object-fit: cover;
    position: relative;
    z-index: 1;
}

.step:hover img {
    transform: scale(1.1) rotate(5deg);
    box-shadow: 0 5px 15px rgba(10, 36, 114, 0.2);
    animation: iconPulse 1s ease infinite;
}

.step p {
    color: #0a2472;
    font-size: 1.25rem;
    font-weight: 500;
    margin: 0;
    transition: all 0.3s ease;
    position: relative;
    z-index: 1;
}

.step:hover p {
    transform: scale(1.05);
    color: #4169e1;
}

.step::after {
    content: attr(data-step);
    position: absolute;
    top: 15px;
    right: 15px;
    font-size: 48px;
    font-weight: 700;
    color: rgba(10, 36, 114, 0.1);
    transition: all 0.4s ease;
    z-index: 0;
}

.step:hover::after {
    transform: scale(1.2);
    color: rgba(10, 36, 114, 0.15);
}

@keyframes iconPulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.1) rotate(5deg); }
    100% { transform: scale(1); }
}

.step:nth-child(1) { animation-delay: 0.1s; }
.step:nth-child(2) { animation-delay: 0.2s; }
.step:nth-child(3) { animation-delay: 0.3s; }
.step:nth-child(4) { animation-delay: 0.4s; }
.step:nth-child(5) { animation-delay: 0.5s; }
.step:nth-child(6) { animation-delay: 0.6s; }
.step:nth-child(7) { animation-delay: 0.7s; }

@media (max-width: 768px) {
    .steps {
        padding: 2rem;
    }

    .step-icons {
        gap: 1.5rem;
    }
    
    .step {
        min-width: 160px;
        padding: 25px;
    }
    
    .step img {
        width: 80px;
        height: 80px;
        padding: 12px;
    }

    .step p {
        font-size: 1.1rem;
    }

    .step::after {
        font-size: 36px;
    }
}

/* New styles for Order Thesis button */
.btn-order {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    width: 140px;
    padding: 10px 15px;
    border-radius: 8px;
    border: 1px solid rgba(10, 36, 114, 1);
    background: rgba(10, 36, 114, 1);
    color: white;
    text-decoration: none;
    font-weight: 500;
    margin-top: 30px;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    font-size: 15px;
    text-align: center;
    justify-content: center;
    position: relative;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(10, 36, 114, 0.2);
}

.btn-order:hover {
    background: rgba(10, 36, 114, 0.9);
    color: white;
    text-decoration: none;
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(10, 36, 114, 0.3);
}

.btn-order:active {
    transform: translateY(1px);
    box-shadow: 0 2px 10px rgba(10, 36, 114, 0.2);
}

.btn-order i {
    font-size: 15px;
    transition: transform 0.3s ease;
}

.btn-order:hover i {
    transform: translateX(3px);
    animation: cartBounce 0.5s ease infinite;
}

@keyframes cartBounce {
    0%, 100% {
        transform: translateX(0);
    }
    50% {
        transform: translateX(3px);
    }
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.reviews {
    padding: 3rem;
    background-color: #f8f9ff;
    border-radius: 10px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    margin-top: 3rem;
}

.review-list {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    margin-bottom: 2rem;
}

.review-item {
    flex: 1 1 calc(50% - 1rem); /* Two items per row with space in between */
    background: white;
    padding: 15px;
    border-radius: 8px;
    margin-bottom: 1rem;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.review-form {
    margin-top: 2rem;
}

.review-form textarea {
    width: 100%;
    padding: 10px;
    border-radius: 5px;
    border: 1px solid #ccc;
    margin-bottom: 1rem;
    resize: none;
}

.footer-container {
  display: flex;
  flex-direction: column;
}

.footer-wrapper {
  background-color: rgba(174, 203, 214, 0.25);
  border-top: 1px solid #000;
  display: flex;
  width: 100%;
  flex-direction: column;
  padding: 139px 80px 21px;
}

.footer-content {
  width: 100%;
  max-width: 1242px;
}

.footer-columns {
  gap: 20px;
  display: flex;
}

.brand-column {
  display: flex;
  flex-direction: column;
  line-height: normal;
  width: 30%;
}

.brand-content {
  display: flex;
  flex-grow: 1;
  flex-direction: column;
}

.brand-title {
  color: rgba(5, 22, 80, 1);
  font: 800 32px Sofia Sans, sans-serif;
}

.payment-section {
  display: flex;
  margin-top: 51px;
  width: 100%;
  flex-direction: column;
}

.payment-title {
  color: #000;
  font: 500 20px/40px Inter, sans-serif;
}

.payment-icons {
  display: flex;
  margin-top: 16px;
  min-height: 49px;
  max-width: 100%;
  width: 182px;
  align-items: start;
  gap: 24px;
}

.payment-icon {
  aspect-ratio: 1.33;
  object-fit: contain;
  object-position: center;
  width: 65px;
}

.payment-icon-alt {
  aspect-ratio: 1.9;
  object-fit: contain;
  object-position: center;
  width: 93px;
}

.contact-column {
  display: flex;
  flex-direction: column;
  line-height: normal;
  width: 20%;
  margin-left: 20px;
}

.contact-content {
  display: flex;
  flex-direction: column;
}

.contact-title {
  color: #000;
  text-transform: capitalize;
  font: 500 32px/1 Inter, sans-serif;
}

.contact-icons {
  display: flex;
  margin-top: 16px;
  align-items: start;
  gap: 26px;
}

.contact-icon {
  aspect-ratio: 1.13;
  object-fit: contain;
  object-position: center;
  width: 70px;
}

.contact-icon-alt {
  display: flex;
  width: 36px;
  height: 36px;
}

.support-column {
  display: flex;
  flex-direction: column;
  line-height: normal;
  width: 18%;
  margin-left: 20px;
}

.support-content {
  display: flex;
  flex-direction: column;
  color: #000;
  white-space: nowrap;
  font: 400 22px/1 Inter, sans-serif;
}

.support-title {
  font-size: 32px;
  font-weight: 500;
  line-height: 1;
  text-transform: capitalize;
}

.support-link {
  margin-top: 16px;
}

.location-column {
  display: flex;
  flex-direction: column;
  line-height: normal;
  width: 32%;
  margin-left: 20px;
}

.location-content {
  display: flex;
  flex-direction: column;
  font-family: Inter, sans-serif;
  color: #000;
}

.location-title {
  font-size: 32px;
  font-weight: 500;
  line-height: 1;
  text-transform: capitalize;
}

.location-address {
  font-size: 22px;
  font-weight: 400;
  line-height: 24px;
  margin-top: 16px;
}

.footer-divider {
  background-color: #c6c6c6;
  margin-top: 27px;
  height: 0;
  border: 1px solid rgba(198, 198, 198, 1);
}

.footer-copyright {
  color: #000;
  align-self: center;
  margin: 87px 0 0 117px;
  font: 400 22px/1 Inter, sans-serif;
}

@media (max-width: 991px) {
  .footer-wrapper {
    max-width: 100%;
    padding: 100px 20px 0;
  }

  .footer-content {
    max-width: 100%;
  }

  .footer-columns {
    flex-direction: column;
    align-items: stretch;
    gap: 0;
  }

  .brand-column,
  .contact-column,
  .support-column,
  .location-column {
    width: 100%;
    margin-left: 0;
  }

  .brand-content,
  .contact-content,
  .support-content,
  .location-content {
    margin-top: 40px;
  }

  .payment-section {
    margin-top: 40px;
  }

  .support-content {
    white-space: initial;
  }

  .footer-divider {
    max-width: 100%;
  }

  .footer-copyright {
    margin-top: 40px;
  }
}
</style>

<div class="thesis-container">
  <div class="image-column">
    <img
      loading="lazy"
      src="https://cdn.builder.io/api/v1/image/assets/TEMP/274e56cc5d08b314fb40edc6e84a4f916af8aaec6e2a1fb1ded319e43669ea19?apiKey=b56619f457e04fabb944a490a22592a3&"
      class="thesis-image"
      alt="Thesis printing process illustration"
    />
  </div>
  <div class="content-column">
    <div class="content-wrapper">
      <h1 class="heading-primary">
        Streamline your
        <span class="highlight-text">
          Thesis Printing Process
        </span>
        and Enjoy top-quality results effortlessly
      </h1>
      <p class="description-text">
        Providing high-quality thesis printing services tailored to your
        needs, with options for customization and affordable pricing, ensuring
        your academic work is presented at its best. Experience hassle-free
        thesis printing with a user-friendly platform designed to deliver
        exceptional quality and convenience, leaving a lasting impression on
        your academic achievements.
      </p>
      @auth
          <a href="{{ route('orders.create') }}" class="btn-order">
              <i class="fas fa-shopping-cart"></i>
              Order Thesis
          </a>
      @else
          <a href="{{ route('login') }}" class="btn-order">
              <i class="fas fa-shopping-cart"></i>
              Order Thesis
          </a>
      @endauth
    </div>
  </div>
</div>

<!-- How You Can Order Section -->
<section class="steps">
    <h2>How You Can Order</h2>
    <div class="step-icons">
        <div class="step" data-step="1">
            <img src="{{ asset('images/customization.jpg') }}" alt="Customization">
            <p>Customization</p>
        </div>
        <div class="step" data-step="2">
            <img src="{{ asset('images/upload.jpg') }}" alt="Upload">
            <p>Upload</p>
        </div>
        <div class="step" data-step="3">
            <img src="{{ asset('images/review details.jpg') }}" alt="Review Details">
            <p>Review Details</p>
        </div>
        <div class="step" data-step="4">
            <img src="{{ asset('images/Payment Method.jpg') }}" alt="Payment Method">
            <p>Payment Method</p>
        </div>
        <div class="step" data-step="5">
            <img src="{{ asset('images/submit order.jpg') }}" alt="Submit Order">
            <p>Submit Order</p>
        </div>
        <div class="step" data-step="6">
            <img src="{{ asset('images/track order.jpg') }}" alt="Track Order">
            <p>Track Order</p>
        </div>
        <div class="step" data-step="7">
            <img src="{{ asset('images/pickup_delivery.jpg') }}" alt="Delivery/Pickup">
            <p>Delivery/Pickup</p>
        </div>
    </div>
</section>

<section class="reviews">
    @auth
    <div class="review-form">
        <h3>Submit Your Review</h3>
        <form action="{{ route('reviews.store') }}" method="POST">
            @csrf
            <textarea name="review" rows="4" placeholder="Write your review here..." required></textarea>
            <button type="submit" class="btn-order">Submit Review</button>
        </form>
    </div>
    @endauth

    @guest
    <p>Please log in to submit your review.</p>
    @endguest

    <h2>Reviews from Our Customers</h2>
    <div class="review-list">
        <div class="review-item">
            <p><strong>Azran:</strong> Great service! Highly recommend.</p>
        </div>
        <div class="review-item">
            <p><strong>Fatin:</strong> The quality of the thesis printing was excellent!</p>
        </div>
        <!-- More reviews can be added here -->
    </div>
</section>

<div class="footer-container">
  <div class="footer-wrapper">
    <div class="footer-content">
      <div class="footer-columns">
        <div class="brand-column">
          <div class="brand-content">
            <div class="payment-title" style="font-size: 32px; font-weight: 500; line-height: 1; text-transform: capitalize;">Accepted payment</div>
            <div class="payment-section">
              <div class="payment-icons">
                <img loading="lazy" src="https://cdn.builder.io/api/v1/image/assets/TEMP/acb99c93fab29dc9b7365aa22bb2dc7a553998d6c26c2b58a1b8895edabefd86?placeholderIfAbsent=true&apiKey=b56619f457e04fabb944a490a22592a3" class="payment-icon" alt="Payment method 1" />
                <img loading="lazy" src="https://cdn.builder.io/api/v1/image/assets/TEMP/94366e4f21f6b789dffe0e48f9686c9c5cd151828a34a9eb18c15831828f95a8?placeholderIfAbsent=true&apiKey=b56619f457e04fabb944a490a22592a3" class="payment-icon-alt" alt="Payment method 2" />
              </div>
            </div>
          </div>
        </div>
        <div class="contact-column">
          <div class="contact-content">
            <div class="contact-title">Contact</div>
            <div class="contact-icons">
              <img loading="lazy" src="https://cdn.builder.io/api/v1/image/assets/TEMP/519b9a2922af1f30d341e4c51cb80466af1e8263ff2ac1fbfe0ecd4d04a8ba62?placeholderIfAbsent=true&apiKey=b56619f457e04fabb944a490a22592a3" class="contact-icon" alt="Contact method 1" />
              <div class="contact-icon-alt" role="img" aria-label="Contact method 2"></div>
            </div>
          </div>
        </div>
        <div class="support-column">
          <div class="support-content">
            <div class="support-title">Support</div>
            <a href="#" class="support-link">FAQ</a>
            <a href="#" class="support-link">Contact</a>
          </div>
        </div>
        <div class="location-column">
          <div class="location-content">
            <div class="location-title">Location</div>
            <address class="location-address">
              No. 26 Jalan U1/1 Taman Universiti 35900 Tg Malim Perak
            </address>
          </div>
        </div>
      </div>
    </div>
    <div class="footer-divider"></div>
    <div class="footer-copyright">@Powered by Diamond Ace Resources</div>
  </div>
</div>
@endsection