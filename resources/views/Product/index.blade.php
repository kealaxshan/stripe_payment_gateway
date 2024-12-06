<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Products') }}
        </h2>
    </x-slot>

    <div class="container py-6">
        <div class="row row-cols-1 row-cols-md-4 g-4">
            <!-- Loop through each product -->
            @foreach ($products as $product)
            <div class="col mb-4">
                <div class="card h-100">
                    <img src="{{$product->image}}" class="card-img-top" alt="...">
                    <div class="card-body d-flex flex-column">
                        <h3 class="card-title">{{$product->name}}</h3>
                        <h5 class="card-title">₹{{$product->price}}</h5>
                        <p class="card-text">{{$product->description}}</p>
                        <a href="{{route('singleProduct',$product->id)}}" class="btn btn-primary mt-auto">By now</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    
</x-app-layout>

