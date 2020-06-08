@extends('layouts.app')

@section('title')
Botlokwa Health Care
@endsection

@section('content')
<div class="container">
    <br>
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h2>Patient Registration</h2>
        <p class="text-mute">Registering with us is the beginning of second-to-none health care services, the corner-stone to our success till date.</p>
        <form class="form-horizontal" role="form" method="POST" action="{{ route('postRegister') }}">
            {{ csrf_field() }}

            <div class="form-group{{ $errors->has('id') ? ' has-error' : '' }}">
                <label for="id" class="col-md-4 control-label">ID Number</label>

                <div class="col-sm-12">
                    <input id="id" type="text" class="form-control" name="id" value="{{ old('id') }}">

                    @if ($errors->has('id'))
                        <span class="help-block">
                            <strong>{{ $errors->first('id') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                <label for="first_name" class="col-md-4 control-label">First Name(s)</label>

                <div class="col-sm-12">
                    <input id="first_name" type="text" class="form-control" name="first_name" value="{{ old('first_name') }}">

                    @if ($errors->has('first_name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('first_name') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                <label for="last_name" class="col-md-4 control-label">Last Name</label>

                <div class="col-sm-12">
                    <input id="last_name" type="text" class="form-control" name="last_name" value="{{ old('last_name') }}">

                    @if ($errors->has('last_name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('last_name') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            
            <div class="form-group{{ $errors->has('tel_h') ? ' has-error' : '' }}">
                <label for="tel_h" class="col-md-4 control-label">Phone (Home)</label>

                <div class="col-sm-12">
                    <input id="tel_h" type="text" class="form-control" name="tel_h" value="{{ old('tel_h') }}">

                    @if ($errors->has('tel_h'))
                        <span class="help-block">
                            <strong>{{ $errors->first('tel_h') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('tel_w') ? ' has-error' : '' }}">
                <label for="tel_w" class="col-md-4 control-label">Phone (Work)</label>

                <div class="col-sm-12">
                    <input id="tel_w" type="text" class="form-control" name="tel_w" value="{{ old('tel_w') }}">

                    @if ($errors->has('tel_w'))
                        <span class="help-block">
                            <strong>{{ $errors->first('tel_w') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('tel_c') ? ' has-error' : '' }}">
                <label for="tel_c" class="col-md-4 control-label">Phone (Cell)</label>

                <div class="col-sm-12">
                    <input id="tel_c" type="text" class="form-control" name="tel_c" value="{{ old('tel_c') }}">

                    @if ($errors->has('tel_c'))
                        <span class="help-block">
                            <strong>{{ $errors->first('tel_c') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('addr') ? ' has-error' : '' }}">
                <label for="addr" class="col-md-4 control-label">Address </label>
                <div class="col-sm-12">
                    <input id="tel_c" type="text" class="form-control" name="addr" value="{{ old('addr') }}">

                    @if ($errors->has('addr'))
                        <span class="help-block">
                            <strong>{{ $errors->first('addr') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('dob') ? ' has-error' : '' }}">
                <label for="dob" class="col-md-4 control-label">Date of Birth</label>

                <div class="col-sm-12">
                    <input id="dob" type="date" class="form-control" name="dob" value="{{ old('dob') }}">

                    @if ($errors->has('dob'))
                        <span class="help-block">
                            <strong>{{ $errors->first('dob') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('reference') ? ' has-error' : '' }}">
                <label for="reference" class="col-md-4 control-label">Reference</label>

                <div class="col-sm-12">
                    <select name="reference" id="reference" class="form-control">
                        <option disabled selected>Where did you hear about us?</option>
                        <option value="Internet">Internet</option>
                        <option value="Radio">Radio</option>
                        <option value="TV">TV</option>
                        <option value="Magazine">Magazine</option>
                        <option value="Friends">Friends</option>
                    </select>
                    @if ($errors->has('reference'))
                        <span class="help-block">
                            <strong>{{ $errors->first('reference') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label for="gender" class="col-md-4 control-label">Gender</label>
                <div class="col-sm-6">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" id="male" value="M" checked>
                        <label class="form-check-label" for="male">
                            Male
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" id="female" value="F">
                        <label class="form-check-label" for="female">
                            Female
                        </label>
                    </div>
                </div>
            </div>

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                <div class="col-sm-12">
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">

                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password" class="col-md-4 control-label">Password</label>

                <div class="col-sm-12">
                    <input id="password" type="password" class="form-control" name="password">

                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                <div class="col-sm-12">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation">

                    @if ($errors->has('password_confirmation'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-12 col-md-offset-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-btn fa-user"></i> Register
                    </button>
                </div>
            </div>
        </form>
        </div>
    </div>
</div>
@endsection