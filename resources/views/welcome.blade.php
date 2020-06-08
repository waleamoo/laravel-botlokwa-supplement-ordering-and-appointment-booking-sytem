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
            <div class="row">
                <div class="col-sm-12">
                    <img src="{{ URL::to('images/doctor.jpg')}}" class="img-responsive img-thumbnail img-banner" alt="Hello Doctor" width="100%" height="auto" alt="Hello Doctor">
                    <a href="tel:+27012329099" type="submit" class="btn btn-danger btn-lg floating"><i class="fa fa-phone" aria-hidden="true"></i> Call Now </a>
                    <a href="{{ route('getBooking')}}" class="btn btn-success btn-lg floating2"><i class="fa fa-book" aria-hidden="true"></i> Book Appointment</a>
                    <strong class="lead">Welcome to the online platform</h1>
                    <br><br><br><br>
                </div>
            </div>
        
            <div class="row">
                <div class="col-sm-12">
                    <p>We are the providers of top-notch health care services in Limpopo. The health of the community is 
                        top-most priority as such, we provide the best doctors and health care practitioner money can buy to 
                        provide the community with the best health care services using the best technology and practices. 
                    </p>
                    <p>Few of the services we offer:</p>
                    <ul>
                        <li>Treatment for erectile dysfunction</li>
                        <li>Screening and treatment of sleep disorders</li>
                        <li>Family medicine</li>
                        <li>Private laboratory services</li>
                        <li>Check-up and consultation</li>
                        <li>Vaccination</li>
                        <li>Genetic profiling</li>
                        <li>Menopause and andropause treatment</li>
                        <li>Screening for sexually transmissible and blood-borne infections (STD / STBBI)</li>
                        <li>Liquid-based Pap Test (vaginal cytology), HPV screening</li>
                        <li>Psychology</li>
                        <li>Ear cleaning</li>
                        <li>Dental services and more...</li>
                    </ul>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <img src="{{ URL::to('images/wecare.png')}}" class="img-responsive img-thumbnail img-banner" alt="We Care" width="100%" height="auto" alt="We Care">
                </div>
            </div>

            <br>

            <div class="row">
                <div class="col-sm-12 text-content">
                    <div class="panel">
                        <div class="panel-head">
                            Latest Supplements 
                        </div>
                        <div class="panel-body">
                            <div class="row">
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
                                                | <del style="font-size: 1vw; color: grey;">R{{ $supplement->supplement_price_old }}.00</del> 
                                                @endif
                                                </p>
                                            <p style="font-size: 1vw; color: grey;">{{ $supplement->qty_in_stock }} in stock</p>
                                            <!--
                                            
                                            <a href="#" class="btn btn-primary btn-sm">Add to Cart</a>
                                            <a href="#" class="btn btn-warning btn-sm">View</a> -->
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                

                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
       
        </div>
    </div>
</div>
@endsection