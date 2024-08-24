<form action="{{ route('payment.make') }}" method="POST">
    @csrf
    <button type="submit">Pay INR</button>
</form>
