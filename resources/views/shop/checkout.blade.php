@extends('layouts.app')

@section('title')
    Botlokwa Health Care 
@endsection

@section('content')
<div class="container">
    <br>
    <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Checkout</div>
                    <div class="panel-body">
                        <h4><strong>Your Total Order: R{{ $total }}.00</strong></h4>
                        <form action="{{ route('postCheckout') }}" method="post" id="checkout-form">
    
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" id="name" class="form-control" required>
                                </div>
                            </div>
    
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <input type="text" id="address" class="form-control" required name="address">
                                </div>
                            </div>
    
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="card-name">Card Holder Name</label>
                                    <input type="text" id="card-name" class="form-control" required name="name">
                                </div>
                            </div>
    
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="card-number">Credit Card Number</label>
                                    <input type="text" id="card-number" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="card-expiry-month">Expiration Month</label>
                                    <input type="date" id="card-expiry-month" class="form-control" required>
                                </div>
                            </div>
    
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="card-expiry-year">Expiration Year</label>
                                    <input type="text" id="card-expiry-year" class="form-control" required>
                                </div>
                            </div>
    
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="card-cvc">CVC</label>
                                    <input type="text" id="card-cvc" class="form-control" required>
                                </div>
                            </div>
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-success">Buy Now</button>
                        </form>
                    </div>
                </div>
            </div>
    </div>
</div>
@endsection