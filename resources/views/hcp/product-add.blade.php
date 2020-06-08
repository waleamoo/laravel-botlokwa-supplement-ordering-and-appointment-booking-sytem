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
    <div class="col-md-6">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Add Supplement</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" method="POST" action="{{ route('postAddProduct') }}" enctype="multipart/form-data">
          {{ csrf_field() }}
          @include('include.message')
          <div class="box-body">
            <div class="form-group">
              <label for="supName">Supplement Name</label>
              <input type="text" class="form-control" id="supName" name="supplement_name" required
                placeholder="Supplement Name">
            </div>
            <div class="form-group">
              <label for="supPrice">Supplement Price</label>
              <div class="input-group">
                <span class="input-group-addon">R</span>
                <input type="text" class="form-control" required name="supplement_price">
                <span class="input-group-addon">.00</span>
              </div>
            </div>
            <div class="form-group">
              <label for="supDesc">Supplement Description</label>
              <!--<textarea class="form-control" name="supplement-desc" id="supplement-desc" cols="30" rows="10" placeholder="Description.."></textarea>-->
              <div class="box box-info">
                <div class="box-header">
                  <h3 class="box-title">Supplement features
                    <small>Describe the supplement</small>
                  </h3>
                  <!-- tools box -->
                  <div class="pull-right box-tools">
                    <button type="button" class="btn btn-info btn-sm" data-widget="collapse" data-toggle="tooltip"
                      title="Collapse">
                      <i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip"
                      title="Remove">
                      <i class="fa fa-times"></i></button>
                  </div>
                  <!-- /. tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body pad">
                  <textarea id="editor1" name="supplement_description" rows="10" cols="80" required
                    placeholder="Describe.."></textarea>
                </div>
              </div>
              <!-- /.box -->
            </div>
            <div class="form-group">
              <label for="supPic">Supplement Picture</label>
              <input type="file" id="supPic" name="supplement_pic" class="form-control-file" required>
              <p class="help-block">Allowed files png, jpg and jpeg.</p>
            </div>
            <div class="form-group">
              <label for="supCategory">Supplement Category</label>
              <select name="supCategory" id="supCategory" class="form-control">
                <?php $categories = \App\SupplementCategory::all(); ?>
                @foreach ($categories as $category)
                <option value="{{$category->supplement_category_id}}">{{$category->supplement_category_name}}</option>
                @endforeach
              </select>
            </div>

            <div class="form-group">
              <label for="supName">Quantity in Stock</label>
              <input type="text" class="form-control" id="supName" name="qty_in_stock" required
                placeholder="In Stock Quantity">
            </div>
          </div>
          <!-- /.box-body -->

          <div class="box-footer">
            <button type="submit" class="btn btn-primary">Save Supplement</button>
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
          <h3 class="box-title">Add Supplement Category</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form class="form">
          <div class="box-body">

            <div class="form-group">
              <label for="exampleInputEmail1">Supplement Name</label>
              <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Supplement Name">
            </div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <!--<button type="submit" class="btn btn-default">Cancel</button>-->
            <button type="submit" class="btn btn-info pull-right">Add Supplement Category</button>
          </div>
          <!-- /.box-footer -->
        </form>
      </div>
      <!-- /.box -->
      <!-- general form elements disabled -->
      <div class="box box-warning">
        <div class="box-header with-border">
          <h3 class="box-title">Add Discout to Supplement</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
        <form role="form" method="POST" action="{{ route('addSupplementDiscount') }}">
            {{ csrf_field() }}
            <div class="box-body">

              <div class="form-group">
                <label for="supplement_id">Supplement Name</label>
                <select class="form-control" name="supplement_id" id="supplement_id">
                  @foreach ($supplements as $supplement)
                    <option value="{{ $supplement->supplement_id}}">{{ $supplement->supplement_name}}</option>
                  @endforeach
                </select>
              </div>

              <div class="form-group">
                <label for="discount">Discount</label>
                <div class="input-group">
                  <span class="input-group-addon">Discount</span>
                  <input type="text" class="form-control" name="discount">
                  <span class="input-group-addon">%</span>
                </div>
              </div>


            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <!--<button type="submit" class="btn btn-default">Cancel</button>-->
              <button type="submit" class="btn btn-info pull-right">Add Discount</button>
            </div>

          </form>
        </div>
        <!-- /.box-body -->
      </div>
    </div>
    <!--/.col (right) -->
  </div>
  <!-- /.row (main row) -->

  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">All Supplememts (According to Reducing Quantity)</h3>
        </div>

        @include('include.message')
        <!-- /.box-header -->
        <div class="box-body">
          <table id="example2" class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>Name</th>
                <th>Price</th>
                <th>Picture</th>
                <th colspan="2">Qauntity in Stock</th>

              </tr>
            </thead>
            <tbody>
              <tr>
                @foreach ($supplements as $supplement)
                <td>{{ $supplement->supplement_name }}</td>
                <td>{{ $supplement->supplement_price }}</td>
                <td><img src="/images/{{ $supplement->supplement_pic }}" alt="" width="40" height="30"></td>
                <td colspan="2">
                  <form action="{{ route('updateQuantity', ['id' => $supplement->supplement_id])}} " method="POST">
                    {{ csrf_field() }}
                    <input type="text" name="qty" class="form-control form-control-sm" id=""
                      value="{{ $supplement->qty_in_stock }}">
                    <button type="submit" class="btn btn-success btn-sm">Update Quantity</button>
                  </form>
                </td>
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