@extends('layouts.admin.admin_master')

@section('content')
    <div class="container">
        <div class="row">
           

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Coupons</div>
                    <div class="card-body">
                    @if (session('flash_message'))
                        <div class="alert alert-success">
                            {{ session('flash_message') }}
                        </div>
                    @endif
                  
                        <a href="{{ url('/admin/coupon/create') }}" class="btn btn-success btn-sm" title="Add New category">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>
                   
                        <!-- <form method="GET" action="{{ url('/admin/category') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}">
                                <span class="input-group-append">
                                    <button class="btn btn-secondary" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </form> -->

                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Sr No.</th>
                                        <th>Coupon Code</th>
                                        <th>Amount</th>
                                        <th>Amount Type</th>
                                        <th>Expiry Date</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($Coupons as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->coupon_code }}</td>
                                        <td>{{ $item->amount }}</td>
                                        <td>{{ $item->amount_type }}</td>
                                        <td>{{ $item->expiry_date }}</td>
                                        <td>
                                            @if($item->status=='1') 
                                            {{'Active'}}
                                            @else
                                            {{'Inactive'}}
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ url('/admin/coupon/' . $item->id) }}" title="View coupon"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                            <a href="{{ url('/admin/coupon/' . $item->id . '/edit') }}" title="Edit coupon"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                                            <form method="POST" action="{{ url('/admin/coupon' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete coupon" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $Coupons->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
