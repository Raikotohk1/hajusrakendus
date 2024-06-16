<!DOCTYPE html>
<html>
<head>
    <title>Bicycle Shop</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center mb-5">Bicycle Shop</h1>
    <div class="row">
        @foreach($bicycles as $bicycle)
        <div class="col-md-4">
            <div class="card mb-4">
                <img src="{{ $bicycle->image }}" class="card-img-top" alt="{{ $bicycle->title }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $bicycle->title }}</h5>
                    <p class="card-text">{{ $bicycle->description }}</p>
                    <p class="card-text"><strong>Manufactor:</strong> {{ $bicycle->manufactor }}</p>
                    <p class="card-text"><strong>Price:</strong> ${{ $bicycle->price }}</p>
                    <a href="{{ route('addToCart', $bicycle->id) }}" class="btn btn-warning btn-block text-center">Add to Cart</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
</body>
</html>
