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
        <li class="active">Orders</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">

    <!-- /.row -->
    <!-- Main row -->
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">All Customer Orders</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="example2" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>Order ID</th>
                  <th>Cart Items</th>
                  <th>Customer ID</th>
                  <th>Receiver Address</th>
                  <th>Receiver Name</th>
                  <th>Total Price</th>
                  <th>Payment ID</th>
                  <th>Status</th>
                  <th>&nbsp;</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($orders as $order)
                    <tr>
                    <td>{{$order->order_id}}</td>
                    <td>
                        @foreach ($order->cart->items as $item)
                        <?php $name = DB::table('supplements')->where('supplement_id', $item['item']->supplement_id)->value('supplement_name'); ?>
                            <p><strong>{{ $item["qty"] }}</strong> {{ $name }}</p>
                        @endforeach
                    </td>
                    <td>{{$order->user_id}}</td>
                    <td>{{$order->address}}</td>
                    <td>{{$order->name}}</td>
                    <td>R{{$order->totalPrice}}.00</td>
                    <td>{{$order->payment_id}}</td>
                    <td>{{$order->status}}</td>
                    <td>
                        @if ($order->status == "Pending")
                            <a href="{{ route('getCompletedOrder', ['id' => $order->order_id])}}" class="btn btn-success btn-sm">Mark as Completed</a>
                        @endif
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
  </section>
  <!-- /.content -->
@endsection