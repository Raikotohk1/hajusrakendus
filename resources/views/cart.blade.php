<!DOCTYPE html>
<html>
<head>
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <style>
        /* Adjust styling as needed */
        .quantity {
            width: 60px;
            text-align: center;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center mb-5">Shopping Cart</h1>
    <table id="cart" class="table table-bordered table-hover table-condensed">
        <thead>
            <tr>
                <th style="width:50%">Product</th>
                <th style="width:8%">Quantity</th>
                <th style="width:22%" class="text-center">Subtotal</th>
                <th style="width:10%"></th>
            </tr>
        </thead>
        <tbody>
            <?php $total = 0 ?>
            @if(session('cart'))
                @foreach(session('cart') as $id => $details)
                    <?php $total += $details['price'] * $details['quantity'] ?>
                    <tr data-id="{{ $id }}">
                        <td data-th="Product">
                            <div class="row">
                                <div class="col-sm-3 hidden-xs"><img src="{{ $details['photo'] }}" width="50" height="50" class="img-responsive"/></div>
                                <div class="col-sm-9">
                                    <h4 class="nomargin">{{ $details['name'] }}</h4>
                                </div>
                            </div>
                        </td>
                        <td data-th="Quantity">
                            <input type="number" value="{{ $details['quantity'] }}" class="form-control quantity"/>
                        </td>
                        <td data-th="Subtotal" class="text-center subtotal">${{ $details['price'] * $details['quantity'] }}</td>
                        <td class="actions" data-th="">
                            <form action="{{ route('removeFromCart') }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="id" value="{{ $id }}">
                                <button class="btn btn-danger btn-sm">Remove</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3" class="text-right"><strong>Total $<span id="total">{{ $total }}</span></strong></td>
                <td>
                    <a href="{{ route('stripe.checkout', ['total' => $total]) }}" class="btn btn-primary btn-sm">Proceed to Payment</a>
                </td>
            </tr>
        </tfoot>
    </table>
</div>

<script>
    $(document).ready(function(){
        $('.quantity').on('change', function() {
            var id = $(this).closest('tr').data('id');
            var quantity = $(this).val();

            $.ajax({
                url: '{{ route('updateCart') }}',
                method: 'patch',
                data: {
                    id: id,
                    quantity: quantity,
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    $('#total').text(data.total);
                    // Update subtotal for the specific item
                    $('tr[data-id="' + id + '"] .subtotal').text('$' + data.subtotal);
                }
            });
        });
    });
</script>

</body>
</html>
