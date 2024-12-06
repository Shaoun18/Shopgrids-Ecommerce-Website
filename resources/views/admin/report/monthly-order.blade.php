@extends('admin.master')

@section('title')
    Manage Order Report
@endsection

@section('body')
    <div class="row">
        <div class="col-12">
            <div class="card card-body">
                <h3 class="text-center text-danger">{{Session::get('messege')}}</h3>
                <form action="{{route('admin.new-order.report')}}" method="POST">
                    @csrf
                    <div class="row">
                    <div class="col-md-5">
                            <div class="from-group">
                                <label class="">Start Date</label>
                                <input type="date" class="form-control" name="start_date"/>
                            </div>
                        </div>
                    <div class="col-md-5">
                        <div class="from-group">
                            <label class="">End Date</label>
                            <input type="date" class="form-control" name="end_date"/>
                        </div>
                    </div>
                    <div class="col-md-2">
                    <div class="from-group">
                        <input type="submit" class="btn btn-success mt-4 w-100" value="find"/>
                    </div>
                    </div>
                    </div>
            </div>
                </form>
            </div>
        </div>
    </div>
@endsection
