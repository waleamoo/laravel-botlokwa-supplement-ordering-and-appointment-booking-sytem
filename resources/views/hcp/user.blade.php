@extends('layouts.admin')
@section('title')
Botlokwa Health Care | Dashboard
@endsection

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Dashboard
        <small>Control Panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">User</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    
    <!-- /.row -->
    <!-- Main row -->
    <div class="row">
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">All Users at Botlokwa Health Care</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <table id="example2" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Telephone (Home)</th>
                        <th>Telephone (Work)</th>
                        <th>Address</th>
                        <th>Gender</th>
                        <th>Date of Birth</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($users as $user)
                      <tr>
                          <td>{{$user->id}}</td>
                          <td>{{ $user->last_name}} {{$user->first_name}}</td>
                          <td>{{$user->email}}</td>
                          <td>{{$user->tel_h}}</td>
                          <td>{{$user->tel_w}}</td>
                          <td>{{$user->addr}}</td>
                          <td>{{$user->gender}}</td>
                          <td>{{$user->dob}}</td>
                        </tr>
                      @endforeach
                      

                      </tbody>
                    
                  </table>
                </div>
                <!-- /.box-body -->
              </div>
              <!-- /.box -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row (main row) -->
    </div>
    <!-- /.row (main row) -->

  </section>
  <!-- /.content -->
@endsection