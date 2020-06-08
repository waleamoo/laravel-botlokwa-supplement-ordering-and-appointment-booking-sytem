@extends('layouts.app')

@section('title')
    Botlokwa Health Care 
@endsection

@section('content')
<div class="container">
    <br>
    @include('include.message')
    <div class="row">
        
            @if (count($supplements) > 0)
            @foreach ($supplements as $supplement)
            <div class="col-sm-4">
                <div class="card" style="width: 18rem; margin-bottom: 5rem;">
                <a href="{{ route('getSupplement', ['id' => $supplement->supplement_id ])}}"><img class="card-img-top" src="/images/{{ $supplement->supplement_pic}}" alt="Supplement Image" width="259" height="180"></a>
                    @if ($supplement->discount)
                        <p id="discount">{{ $supplement->discount * 100}}%</p>
                    @endif
    
                    <div class="card-body">
                        <h5 class="card-title">{{ $supplement->supplement_name}}</h5>
                        <p class="card-text">R{{ $supplement->supplement_price }}.00 
                            @if ($supplement->supplement_price_old)
                            | <del style="font-size: 1vw; color: grey;">R600.00</del> 
                            @endif
                            </p>
                        <p style="font-size: 1vw; color: grey;">{{ $supplement->qty_in_stock }} in stock</p>
                        <a href="{{ route('getAddToCart', ['id' => $supplement->supplement_id]) }}" class="btn btn-primary btn-sm">Add to Cart</a>
                        <a href="#" class="btn btn-warning btn-sm">View</a>
                    </div>
                </div>
            </div>
            @endforeach
            {{$supplements->links()}}
            @else
                <p class="display-4" style="color:red; margin-bottom: 600px;">We cannot find your supplement</p>
            @endif
    </div>
</div>
@endsection