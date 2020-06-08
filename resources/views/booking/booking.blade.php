@extends('layouts.app')

@section('title')
    Botlokwa Health Care 
@endsection

@section('content')
<div class="container">
    <br>
    <div class="row">
        
        <div class="col-md-8 offset-md-2">
            
            @if (Session::has('booking'))
            <h2>Appointment preview</h2>
            <small class="text-muted">Please confirm your appointment details</small>
            <br>
                    <strong>Your booking details.</strong>
                    <div class='row'>
                        <div class='col'><b>Booking</b></div>
                        <div class='col'><b>Time</b></div>
                        <div class='col'><b>Date</b></div>
                        <div class='col'><b>Price(R)</b></div>
                        <div class='col'><b>Delete</b></div>
                    </div>
                    
                    <div class='row'>
                        <div class='col'>{{ session('service') }}</div>
                        <div class='col'>{{ Session::get('booking')["time"]}}</div>
                        <div class='col'>{{ Session::get('date')}}</div>
                        <div class='col'>R{{ session('price')}}.00</div>
                    <div class='col'><a href="{{route('deleteBooking')}}" class="btn btn-danger btn-sm">Delete</a></div>
                    </div>

                    <div class="row">
                        <div class="col"><a href="{{ route('confirmBooking') }}" class="btn btn-secondary">Confirm Booking</a></div>
                    </div>
                    
                    @else
                        <h1 class="display-4" style="color:red;">No booking placed.</h1>
                    @endif
                    <br>
                                
        </div>
    </div>
</div>
@endsection