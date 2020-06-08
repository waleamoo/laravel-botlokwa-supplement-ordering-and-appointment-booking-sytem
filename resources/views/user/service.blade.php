@extends('layouts.app')

@section('title')
    Botlokwa Health Care 
@endsection

@section('content')
<div class="container">
    <br>
    <div class="row">
        <div class="col-md-12">
            <!--<h2>Contact us</h2>-->
            <div class="row">
                <div class="col-md-12">
                    <h3>{{ $service->service_name}}</h3>
                    <div>
                        {!! $service->service_desc !!}
                    </div>
                </div>
            </div> <!-- end of row -->


        </div>


    </div>
</div>
@endsection