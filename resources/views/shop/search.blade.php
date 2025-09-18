@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Search results for "{{ $query }}"</h2>

    @if($products->count())
        <div class="row">
            @foreach($products as $product)
                <div class="col-md-3 mb-4">
                    <div class="product">
                        <a href="{{ route('product.details', $product->slug) }}">
                            <img src="{{ asset('storage/' . $product->image) }}"
                                 alt="{{ $product->name }}"
                                 class="img-fluid">
                        </a>
                        <h5>{{ $product->name }}</h5>
                        <p>${{ $product->regular_price }}</p>
                    </div>
                </div>
            @endforeach
        </div>

        {{ $products->appends(['q' => $query])->links() }}
    @else
        <p>No products found.</p>
    @endif
</div>
@endsection
