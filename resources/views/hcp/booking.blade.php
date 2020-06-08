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
        <li class="active">Dashboard</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3 class="box-title">Add Health Service</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                <form role="form" action="{{ route('postAddService')}}" method="POST">
                    @include('include.message')
                    {{ csrf_field() }}
                        <div class="form-group">
                            <label for="supName">Service Name</label>
                            <input type="text" class="form-control" id="supName" name="service_name"
                                placeholder="Service Name">
                        </div>

                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Service Description</label>

                                <div class="box-body pad">
                                    <textarea id="editor1" name="service_desc" rows="10" cols="80"
                                        placeholder="Describe.."></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="supPrice">Service Price</label>
                            <div class="input-group">
                                <span class="input-group-addon">R</span>
                                <input type="text" class="form-control" name="service_price">
                                <span class="input-group-addon">.00</span>
                              </div>
                          </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <!--<button type="submit" class="btn btn-default">Cancel</button>-->
                            <button type="submit" class="btn btn-info pull-left">Add Service</button>
                        </div>
                    </form>
                </div>
                <!-- /.box-body -->
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">All Booking</h3>
            </div>

            @include('include.message')
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>User Name</th>
                    <th>Booking Date</th>
                    <th>Service</th>
                    <th>Status</th>
                    <th>Amount</th>
                      <th>&nbsp;</th>
                      <th>&nbsp;</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($books as $book)
                    <tr>
                        <td>{{App\User::where('id', $book->user_id)->value('last_name')}} {{App\User::where('id', $book->user_id)->value('last_name')}}</td>
                            <td>{{$book->booking_date}}</td>
                            <td>{{App\Service::where('id', $book->service_id)->value('service_name')}}</td>
                            <td>{{$book->status}}</td>
                            <td>R{{$book->booking_total}}.00</td>
                            @if ($book->status == 'pending')
                            <td><a href="{{ route('getCompleted', ['id' => $book->id])}}" class="btn btn-warning btn-outline-primary">Completed</a></td>
                            @endif
                            
                            <td><a href="{{ route('getDelete', ['id' => $book->id])}}" class="btn btn-danger btn-outline-primary">Delete</a></td>
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
        <!-- /.col -->

      </section>
<!-- /.content -->
@endsection