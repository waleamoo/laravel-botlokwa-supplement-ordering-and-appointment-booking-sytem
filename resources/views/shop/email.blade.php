<p>Hi {{ $name }},</p>
<p>{{ $body }} to be delivered to {{ $receiver_name }} at address; {{ $address }}</p>

@foreach ($orders as $order)
    <p>Order Number: <strong>{{ $order->order_id}}</strong></p>
    @foreach($order->cart->items as $item)
    <p>
        <span class="badge badge-danger"> R{{ $item['price'] }}.00</span>
        <img src="{{ asset("src/images/" . $item["item"]->supplement_pic) }}" 
        width="20" height="20"
            class="img-responsive pull-left"> | {{ $item['item']->supplement_name }} | {{ $item['qty']}} Units
    </p>
    @endforeach
    <strong>Total Price: R{{ $order->cart->totalPrice }}.00</strong>
@endforeach