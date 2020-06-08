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
        <li class="active">Admin</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    
    <!-- /.row -->
    <!-- Main row -->
    <div class="row">
        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Register Admin</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form">
              <div class="box-body">

                <div class="form-group">
                    <label for="exampleInputEmail1">Admin Name</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Email">
                  </div>

                <div class="form-group">
                  <label for="exampleInputEmail1">Admin Email</label>
                  <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Admin Password</label>
                    <input type="password" class="form-control" id="exampleInputEmail1" placeholder="Password">
                  </div>
                  <div class="form-group">
                      <label for="exampleInputEmail1">Admin Password Confirm</label>
                      <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Confirm Password">
                    </div>
                
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Register Admin User</button>
              </div>
            </form>
          </div>
          <!-- /.box -->
        </div>
        <!--/.col (left) -->
        <!-- right column -->
        <div class="col-md-6">
          <!-- Horizontal Form -->
          <div class="box box-info">
              <div class="box-header with-border">
                <h3 class="box-title">Update Admin Details</h3>
              </div>
              <!-- /.box-header -->
              <!-- form start -->
              <form class="form">
                  <div class="box-body">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Admin Email</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
                      </div>
                      <div class="form-group">
                          <label for="exampleInputEmail1">Admin Password</label>
                          <input type="password" class="form-control" id="exampleInputEmail1" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Admin Password Confirm</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Confirm Password">
                          </div>
                      
                    </div>
                <!-- /.box-body -->
                <div class="box-footer">
                  <!--<button type="submit" class="btn btn-default">Cancel</button>-->
                  <button type="submit" class="btn btn-info pull-right">Update Admin Details</button>
                </div>
                <!-- /.box-footer -->
              </form>
            </div>
        </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row (main row) -->

  </section>
  <!-- /.content -->
@endsection