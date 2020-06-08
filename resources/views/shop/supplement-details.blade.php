@extends('layouts.app')

@section('title')
    Botlokwa Health Care 
@endsection

@section('content')
<div class="container">
    <br>
    <div class="row">
        <div class="col-md-12">
            @include('include.message')
            @foreach ($supplements as $supplement)
            <div class="col-sm-8" style="margin-bottom: 150px;">

                <img class="img-responsive" src="/images/{{ $supplement->supplement_pic}}" alt="Supplement Image" width="259" height="180">
                    @if ($supplement->discount)
                    <p id="discount">{{ $supplement->discount * 100}}%</p>
                    @endif
                        <h5>{{ $supplement->supplement_name}}</h5>
                        <p>R{{ $supplement->supplement_price }}.00 
                            @if ($supplement->supplement_price_old)
                            | <del style="font-size: 1vw; color: grey;">R600.00</del> 
                            @endif
                            </p>
                        <p>{!! $supplement->supplement_description !!}</p>
                        <p style="font-size: 1vw; color: grey;">{{ $supplement->qty_in_stock }} in stock</p>
                        <a href="{{ route('getAddToCart', ['id' => $supplement->supplement_id]) }}" class="btn btn-primary btn-sm">Add to Cart</a>

                <hr>
                <!-- list all the previous reviews -->
                @foreach ($supplement_ratings as $rating)
                <div class="card card-body bg-light">
                    <input type="hidden" name="rating-number" id="rating-number" value="{{ $rating->rating }}">
                    <p><b>{{ App\User::where('id', $rating->user_id)->value('last_name')}}</b></p>
                    <p>{{ $rating->msg }}</p>

                    @if ($rating->rating > 0)
                        <!-- Rating Stars Box -->
                        <div class='rating-stars-show'>
                            <ul id='stars-show'>
                                <li class='star-show' title='Poor' data-value='1'>
                                    <i class='fa fa-star fa-fw'></i>
                                </li>
                                <li class='star-show' title='Fair' data-value='2'>
                                    <i class='fa fa-star fa-fw'></i>
                                </li>
                                <li class='star-show' title='Good' data-value='3'>
                                    <i class='fa fa-star fa-fw'></i>
                                </li>
                                <li class='star-show' title='Excellent' data-value='4'>
                                    <i class='fa fa-star fa-fw'></i>
                                </li>
                                <li class='star-show' title='WOW!!!' data-value='5'>
                                    <i class='fa fa-star fa-fw'></i>
                                </li>
                            </ul>
                        </div>
                    @endif

                </div>
                @endforeach
                <hr>
                @if (Auth::check())
                    <form action="{{ route('postReview', ['id' => $supplement->supplement_id])}}" method="POST">
                        @include('include.message')
                        {{ csrf_field() }}
                        
                        <input type="hidden" name="rating" id="rating" value="">
                        <div class="form-group">
                            <label for="">What can you say about this {{ $supplement->supplement_name}} product?</label>
                            <textarea class="form-control" required name="msg" cols="5" rows="5" placeholder="What can you say about this product?"></textarea>
                        </div>

                        <!-- Rating Stars Box -->
                        <div class='rating-stars text-center'>
                            <ul id='stars'>
                                <li class='star' title='Poor' data-value='1'>
                                    <i class='fa fa-star fa-fw'></i>
                                </li>
                                <li class='star' title='Fair' data-value='2'>
                                    <i class='fa fa-star fa-fw'></i>
                                </li>
                                <li class='star' title='Good' data-value='3'>
                                    <i class='fa fa-star fa-fw'></i>
                                </li>
                                <li class='star' title='Excellent' data-value='4'>
                                    <i class='fa fa-star fa-fw'></i>
                                </li>
                                <li class='star' title='WOW!!!' data-value='5'>
                                    <i class='fa fa-star fa-fw'></i>
                                </li>
                            </ul>
                        </div>

                        <button type="submit" class="btn btn-primary">Send Review</button>
                    </form>

                @else
                <span class="lead"><a href="{{ url('/login')}}">Login to write a review on this product</a></span>
                @endif
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection