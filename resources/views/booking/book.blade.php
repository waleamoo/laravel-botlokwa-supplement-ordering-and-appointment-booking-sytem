@extends('layouts.app')

@section('title')
    Botlokwa Health Care 
@endsection

@section('content')
<div class="container">
    <br>
    <div class="row">
        
        <div class="col-md-6">
            @include('include.message')
            <h2>Book an appointment</h2>
        <form class="form-horizontal" role="form" method="POST" action="{{ route('postBooking')}}">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="service" class="col-sm-12 control-label">Health Service to Book</label>

                    <div class="col-md-6">
                        <select name="service" id="service" class="form-control">
                            @foreach ($services as $s)
                            <option value="{{ $s->id }}">{{ $s->service_name }} @ R{{ $s->service_price }}.00</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                        <label for="time" class="col-md-4 control-label">Time</label>

                        <div class="col-md-6">
                            <select name="time" id="time" class="form-control">
                                <option value="09:00">09:00 AM</option>
                                <option value="11:00">11:00AM</option>
                                <option value="13:00">1:00PM</option>
                                <option value="15:00">3:00PM</option>
                            </select>
                        </div>
                    </div>

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-btn fa-book"></i> Book Appoitment
                        </button>
                    </div>
                </div>
            </form>

        </div>

        <div class="col-md-6">
            <h2>Pending Bookings for Today</h2>
            <table class="table-responsive-lg table-bordered table p-4">
                <tr><th>Time</th><th>Number of Bookings</th></tr>
                <tr><td>09: 00 AM</td><td>{{ isset($nine) ? $nine : '0' }}</td></tr>
                <tr><td>11: 00 AM</td><td>{{ isset($eleven) ? $eleven : '0' }}</td></tr>
                <tr><td>01: 00 PM</td><td>{{ isset($one) ? $one : '0' }}</td></tr>
                <tr><td>03: 00 PM</td><td>{{ isset($three) ? $three : '0' }}</td></tr>
            </table>
        </div>
    </div>
</div>
@endsection