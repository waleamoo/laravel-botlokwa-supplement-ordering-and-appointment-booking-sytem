@extends('layouts.app')

@section('title')
    Botlokwa Health Care 
@endsection

@section('content')
<div class="container">
    <br>
    <div class="row">
        <h2>Your profile area</h2>
    </div>
    <div class="row">
        <div class="col-md-6">
                @include('include.message')
                <!-- user booking and previous supplement order  -->

                <a href="{{ route('getBooking') }}" class="btn btn-success btn-secondary btn-outline-danger text-white">Make an appointment</a>
                <hr>    
                <h2>Bookings</h2>            
                @if(count($appointments) > 0)
                @foreach ($appointments as $book)
                    <div class="card card-body bg-light">
                        <p>{{ App\Service::where('id', $book->id)->value('service_name')}} on <b>{{$book->booking_date}}</b></p>
                    </div>
                @endforeach
                @else
                <p class="display-4" style="color:red">No previous booking(s)</p>
                @endif
        </div>

        <div class="col-md-6">
            <h2>Orders</h2>
            <hr>    
                <h2>Order</h2>            
                @if(count($orders) > 0)
                @foreach ($orders as $order)
                    <div class="card card-body bg-light">
                        <p>Order ID: {{ $order->order_id }} on <b>{{ $order->created_at }}</b></p>
                    </div>
                @endforeach
                @else
                <p class="display-4" style="color:red">No previous Orders(s)</p>
                @endif
        </div>
    </div>
</div>
@endsection
