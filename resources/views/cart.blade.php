<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        @section('content')
        <h1 class="m-4 font-bold">Shopping Cart</h1>
        <div class="cart">

            @if(session()->has('cart') && count(session('cart')) > 0)
            <div class="cart-item grid grid-row grid-cols-4 m-4 h-12 items-center">
                @foreach(session('cart') as $index => $cartItem)
                <div>
                    <h2 class="pb-4">{{ $cartItem['name'] }}</h2>
                </div>
                    <div>
                        <form action="{{ route('updateCartItem', $index) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <p>
                                Quantity:
                                <input class="w-16" type="number" name="quantity" value="{{ $cartItem['quantity'] }}" min="1" max="99"/>
                                <button type="submit">Update</button>
                            </p>
                        </form>
                    </div>
                    <div  class="text-center">
                        <p class="pb-4">Price: {{ $cartItem['price'] }} €</p>
                    </div>
                    <div class="text-right">
                        <form action="{{ route('removeFromCart', $index) }}" method="POST">
                            @csrf
                            @method('POST')
                            <button class="text-right" type="submit">X</button>
                        </form>
                    </div>
                    @endforeach
                    @if(session()->has('coupon'))
                        @php
                            $coupon = session('coupon');
                        @endphp
                        <div>
                            <h2 class="pb-4">{{ $coupon['code'] }}</h2>
                        </div>
                        <div>
                            <p>
                                Quantity: 1
                            </p>
                        </div>
                        <div>
                            <p class="text-center">
                                Discount: {{$coupon['discount']}} €
                            </p>
                        </div>
                        <div class="text-right">
                            <form action="{{ route('removeCoupon') }}" method="POST">
                                @csrf
                                @method('POST')
                                <button class="text-right" type="submit">X</button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
            <div class="pt-16">
                <div class="p-4">
                <form action="/apply-coupon" method="POST">
                    @csrf
                    
                    <input type="text" name="coupon_code"/>
                    <button type="submit">Apply Coupon</button>
                </form>
                </div>
                <p class="m-4 font-bold">total sum: {{ $total }} €</p>
                <div class="m-4 font-bold flex flex-row justify-between">
                    <a href="{{ route('records') }}">
                        <button>Back to shopping</button>
                    </a>
                    <form action="{{ route('checkout.checkout') }}" method="POST">
                        @csrf
                        <button type="submit">
                            Checkout
                        </button>
                    </form>
                </div>
            </div>        
    </div>
        @else
    <div>
        <div class="my-4 mx-6">
            <p class="my-2">No items in cart</p>
            <a href="{{ route('bicycles.index') }}">
                <button>
                    Back to shopping
                </button>
            </a>
        </div>
    </div>
        @endif
</div>