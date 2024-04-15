<div>
    Dear, <h1>{{ $user->name }}</h1> <br>

    <p>We are sorry to inform you that the product <strong>{{ $product->name }}</strong> is less than 10 pieces. </p>

    @if($quantity)
        <p>Current Quantity: {{$quantity}}</p>
    @endif
</div>
