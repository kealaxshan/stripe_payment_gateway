<x-app-layout>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg">
                    <div class="card-body">
                        <h2 class="card-title text-center text-success">Payment Successful!</h2>

                        <div class="text-center">
                            <p class="lead">Thank you for your purchase! Your payment has been successfully processed.</p>
                            <p><strong>Order ID:</strong> {{ $payment->id }}</p>
                            <p><strong>Amount Paid:</strong> ₹{{ number_format($payment->amount, 2) }}</p>
                            <p><strong>Status:</strong> {{ $payment->status }}</p>

                            <div class="mt-4">
                                <a href="{{ route('getProducts') }}" class="btn btn-primary">
                                    <i class="bi bi-arrow-left"></i> Continue Shopping
                                </a>
                            </div><div class="mt-4">
                                <a href="{{ route('invoice.download',$payment->id)}}" class="btn btn-warning">
                                    <i class="bi bi-arrow-left"></i> download invoice
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
