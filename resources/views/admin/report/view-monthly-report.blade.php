@extends('admin.master')

@section('title')
    Report Order Page
@endsection

@section('body')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Order Report Page</h4>

                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>Serial Name</th>
                            <th>Order No</th>
                            <th>payment Method</th>
                            <th>Order Status</th>
                            <th>Payment Status</th>
                            <th>Delivery Status</th>
                            <th>Order Date</th>
                        </tr>
                        </thead>

                        <tbody>
                        <h4 class="text-center text-success">{{Session::get('message')}}</h4>

                        @foreach($orders as $order)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$order->id}}</td>
                                <td>{{$order->payment_method == 1 ? 'cash on delivery' : ($order->payment_method == 2 ? 'Online payment' : 'Mobile Banking')}}</td>
                                <td>{{$order->order_status}}</td>
                                <td>{{$order->payment_status}}</td>
                                <td>{{$order->delivery_status}}</td>
                                <td>{{$order->order_date}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
@endsection

