@extends('layout.app')
@section('content')

<div class="mx-5 text-center">
    <form action="{!! route('payment.success', $eventRegistrationId) !!}" method="POST" id="razorpay-form">
        @csrf
        <img src="https://upload.wikimedia.org/wikipedia/commons/8/89/Razorpay_logo.svg" alt="Razorpay Logo" style="width: 50%; margin-bottom: 20px;">
        <p>Accept all types of payment available in India</p>

        <script src="https://checkout.razorpay.com/v1/checkout.js"
                data-key="{{ env('RAZORPAY_KEY_ID') }}"
                data-amount="{{ $amount }}"
                data-currency="INR"
                data-order_id="{{ $order->id }}"
                 data-name="EGSPEC"
                data-description="Event Registration"
                data-buttontext="Make Payment to register the event">
        </script>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
    </form>
</div>

<style>
    #razorpay-form {
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    #razorpay-form script {
        width: 100%;
        margin-bottom: 20px;
    }
    #razorpay-form img {
        width: auto;
        height: 50%;
        margin-bottom: 20px;
    }
    #razorpay-form p {
        margin-bottom: 20px;
    }

    .razorpay-payment-button {
  background-color: #4CAF50; /* Green */
  color: #ffffff;
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

.razorpay-payment-button:hover {
  background-color: #3e8e41; /* Darker green on hover */
}

.razorpay-payment-button:active {
  background-color: #3e8e41;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}
</style>

@endsection
