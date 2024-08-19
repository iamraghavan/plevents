<form action="{{ route('payment.make') }}" method="POST">
    @csrf
    <button type="submit">Pay INR 1</button>
</form>
