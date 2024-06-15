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
                </div>
                <form id="addToCartForm" action="{{ route('addToCart', ['product_id' => $bicycle['id'], 'quantity' => ':amount']) }}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $bicycle['product_id'] }}">
                    <label for="amount">
                        Select amount:
                    </label>
                    <input type="number" id="amount" name="amount" min="1" max="99" value="1" />
                    <button type="submit">
                        Add to Cart
                    </button>
                </form>
            </div>
        </div>
        
        @endforeach
    </div>
</div>
<script>
    document.getElementById('amount').addEventListener('change', function() {
        var amount = this.value;
        var formAction = "{{ route('addToCart', ['product_id' => $bicycle['id'], 'quantity' => ':amount']) }}";
        formAction = formAction.replace(':amount', amount);
        document.getElementById('addToCartForm').action = formAction;
    });
</script>
</body>
</html>
