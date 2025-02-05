@extends('layouts.app')

@section('content')
<style>
  .main-container {
    border-radius: 0;
    display: flex;
    flex-direction: column;
    color: rgba(1, 8, 45, 1);
    font: 40px Sofia Sans, sans-serif;
  }
  .content-wrapper {
    background-color: rgba(226, 234, 252, 1);
    display: flex;
    width: 100%;
    flex-direction: column;
    align-items: center;
    padding: 72px 80px 139px;
  }
  @media (max-width: 991px) {
    .content-wrapper {
      max-width: 100%;
      padding: 0 20px 100px;
    }
  }
  .inner-wrapper {
    display: flex;
    width: 100%;
    max-width: 924px;
    flex-direction: column;
    align-items: center;
    margin: 0 0 -28px 18px;
  }
  @media (max-width: 991px) {
    .inner-wrapper {
      max-width: 100%;
      margin-bottom: 10px;
    }
  }
  .image {
    aspect-ratio: 1.35;
    object-fit: contain;
    object-position: center;
    width: 348px;
    box-shadow: 0 4px 4px rgba(0, 0, 0, 0.25);
    max-width: 100%;
  }
  .verified-title {
    font-weight: 800;
    margin-top: 82px;
  }
  @media (max-width: 991px) {
    .verified-title {
      margin-top: 40px;
    }
  }
  .description-text {
    font-weight: 400;
    text-align: center;
    align-self: stretch;
    margin-top: 33px;
  }
  @media (max-width: 991px) {
    .description-text {
      max-width: 100%;
    }
  }
  .actions-wrapper {
    display: flex;
    margin-top: 76px;
    width: 703px;
    max-width: 100%;
    gap: 40px 49px;
    color: var(--Black, #000);
    white-space: nowrap;
    text-align: center;
    text-transform: capitalize;
    flex-wrap: wrap;
    font: 500 32px/1 Inter, sans-serif;
  }
  @media (max-width: 991px) {
    .actions-wrapper {
      margin-top: 40px;
      white-space: initial;
    }
  }
  .no-button-wrapper {
    justify-content: center;
    align-items: center;
    border-radius: 8px;
    border: 1px solid var(--Black, #000);
    background-color: rgba(246, 150, 151, 0.73);
    display: flex;
    min-height: 85px;
    gap: 8px;
    flex: 1;
    padding: 23px 24px;
    cursor: pointer;
  }
  @media (max-width: 991px) {
    .no-button-wrapper {
      white-space: initial;
      padding: 0 20px;
    }
  }
  .no-button {
    align-self: stretch;
    width: 152px;
  }
  @media (max-width: 991px) {
    .no-button {
      white-space: initial;
    }
  }
  .yes-button-wrapper {
    justify-content: center;
    align-items: center;
    border-radius: 8px;
    border: 1px solid var(--Black, #000);
    background-color: rgba(152, 251, 152, 0.73);
    display: flex;
    min-height: 85px;
    gap: 8px;
    flex: 1;
    padding: 23px 24px;
    cursor: pointer;
  }
  @media (max-width: 991px) {
    .yes-button-wrapper {
      white-space: initial;
      padding: 0 20px;
    }
  }
  .yes-button {
    align-self: stretch;
    width: 152px;
  }
  @media (max-width: 991px) {
    .yes-button {
      white-space: initial;
    }
  }
</style>

<div class="main-container">
  <div class="content-wrapper">
    <div class="inner-wrapper">
      <img
        loading="lazy"
        src="https://cdn.builder.io/api/v1/image/assets/TEMP/36dc540071977b5b49a17c868b98b4989fa742bdf5fa8f6293b58d2d7d90168a?placeholderIfAbsent=true&apiKey=b56619f457e04fabb944a490a22592a3"
        class="image"
        alt="Payment Verified Icon"
      />
      <div class="verified-title">Payment Verified !</div>
      <div class="description-text">
        You have verified the payment! Do you want to change the order status
        from<br /><br />
        'Payment Verified' to 'Printing in Progress'
      </div>
      <div class="actions-wrapper">
        <form action="{{ route('admin.orders.update.status', $order->id) }}" method="POST" style="display: contents;">
            @csrf
            <input type="hidden" name="status" value="payment_verified">
            <button type="submit" class="no-button-wrapper" style="border: none;">
                <div class="no-button">No</div>
            </button>
        </form>
        <form action="{{ route('admin.orders.update.status', $order->id) }}" method="POST" style="display: contents;">
            @csrf
            <input type="hidden" name="status" value="printing">
            <button type="submit" class="yes-button-wrapper" style="border: none;">
                <div class="yes-button">Yes</div>
            </button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
