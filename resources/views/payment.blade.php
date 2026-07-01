<form action="{{ route('wallet.pay') }}" method="POST">
    @csrf
    <input type="number" name="amount" required placeholder="Amount">
    <button type="submit" class="btn btn-primary">Pay with Stripe</button>
</form>
