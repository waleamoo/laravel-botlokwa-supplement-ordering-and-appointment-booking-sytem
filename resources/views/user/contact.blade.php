@extends('layouts.app')

@section('title')
    Botlokwa Health Care 
@endsection

@section('content')
<div class="container">
    <br>
    <div class="row">
        <div class="col-md-12">
            <h2>Contact us</h2>

            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            Reach us at:
                        </div>
                        <div class="card-body">
                            <p>
                                445 Botlokwa Ga Makgato
                                <br>Limpopo, MP
                                <br>
                            </p>
                            <p>
                                <abbr title="Phone">P</abbr>: <a href="tel:+01-232-00011">01-232-00001</a> or <a href="tel:+01-232-00011">01-232-00011</a>
                            </p>
                            <p>
                                <abbr title="Email">E</abbr>:
                                <a href="mailto:name@example.com">hello@botlokwa.co.za
                                </a>
                            </p>
                        </div>
                    </div>
        
        
        
                </div>
        
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            Contact us
                        </div>
                        <div class="card-body">
                            <iframe width="100%" height="400px" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"
                                src="http://maps.google.com/maps?hl=en&amp;ie=UTF8&amp;ll=37.0625,-95.677068&amp;spn=56.506174,79.013672&amp;t=m&amp;z=4&amp;output=embed"></iframe>
                            <hr>
                            <form>
                                <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" id="name" placeholder="Name">
                                        
                                    </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email address</label>
                                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                                </div>
        
                                <div class="form-group">
                                        <label for="phone">Phone</label>
                                        <input type="phone" class="form-control" id="phone" aria-describedby="phone" placeholder="Phone">
                                       
                                    </div>
        
        
                                <div class="form-group">
                                    <label for="msg">Message</label>
                                    <textarea class="form-control" name="msg" id="msg" cols="30" rows="10" placeholder="Your message.."></textarea>
                                </div>
                                
                                <button type="submit" class="btn btn-primary btn-lg">Send</button>
                                </form>
                    
                        </div>
                    </div>
                </div>
            </div> <!-- end of row -->


        </div>


    </div>
</div>
@endsection