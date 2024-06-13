<div class="product-container">
    @foreach ($products as $product)
        <div class="product-card">
            <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}" class="product-image" width="400" height="400">
            <div class="product-details">
                <h2 class="product-name">{{ $product['name'] }}</h2>
                <p class="product-author">Artist: {{ $product['author'] }}</p>
                <p class="product-tracks">Tracks: {{ $product['tracks'] }}</p>
                <p class="product-price">Price: ${{ $product['price'] }}</p>
                
            </div>
        </div>
    @endforeach
</div>