<form action="{{ route('payment.success') }}" method="POST">
    @csrf
    <script src="https://checkout.razorpay.com/v1/checkout.js"
            data-key="{{ env('RAZORPAY_KEY_ID') }}"
            data-amount="{{ $amount }}"
            data-currency="INR"
            data-order_id="{{ $order }}"
            data-buttontext="Pay Now">
    </script>
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
</form>
