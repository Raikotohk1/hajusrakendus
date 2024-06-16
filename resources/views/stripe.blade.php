<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 50px;
        }
        .card-img-top {
            height: 300px;
            object-fit: cover;
        }
        .card {
            border: 1px solid #ccc;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .card-body {
            text-align: center;
        }
        .btn-pay {
            background-color: #007bff;
            color: #fff;
            border: none;
        }
        .btn-pay:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Your Cart</h5>
                        <ul class="list-group mb-3">
                            @foreach(session('cart') as $id => $details)
                            <li class="list-group-item d-flex justify-content-between lh-sm">
                                <div>
                                    <h6 class="my-0">{{ $details['name'] }}</h6>
                                    <small class="text-muted">Quantity: {{ $details['quantity'] }}</small>
                                </div>
                                <span class="text-muted">${{ $details['price'] * $details['quantity'] }}</span>
                            </li>
                            @endforeach
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Total (USD)</span>
                                <strong>${{ $total }}</strong>
                            </li>
                        </ul>
                        <a href="{{ route('stripe.checkout') }}" class="btn btn-pay btn-lg">Proceed to Payment</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
