<x-app-layout>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg">
                    <!-- Product Image -->
                    <img src="{{ $product->image }}" class="card-img-top" alt="{{ $product->name }}">

                    <div class="card-body">
                        <h2 class="card-title text-center">{{ $product->name }}</h2>
                        <p class="text-muted text-center">
                            Price: <strong>₹{{ number_format($product->price, 2) }}</strong>
                        </p>
                        <p class="card-text text-center">{{ $product->description }}</p>

                        <hr>

                        <!-- Stripe Checkout Button -->
                       
                        <form action="{{ route('stripe.checkout', $product->id) }}" method="POST">
                            @csrf
                            <!-- Form fields for checkout -->
                            <button type="submit" class="btn btn-success mt-3">Checkout</button>
                        </form>
                    </div>
                </div>

                <!-- Back to Products Button -->
                <div class="text-center mt-4">
                    <a href="{{ route('getProducts') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Back to Products
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
