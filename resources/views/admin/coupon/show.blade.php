@extends('layouts.admin.admin_master')

@section('content')
    <div class="container">
        <div class="row">
           

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Coupon {{ $coupon->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/admin/coupon') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/admin/coupon/' . $coupon->id . '/edit') }}" title="Edit coupon"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('admin/coupon' . '/' . $coupon->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete coupon" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $coupon->id }}</td>
                                    </tr>
                                    <tr><th> Coupon Code </th>
                                    <td> {{ $coupon->coupon_code }} </td>
                                    </tr>
                                    <tr>
                                        <th> Amount Type </th><td> {{ $coupon->amount_type }} </td>
                                    </tr>
                                    <tr>
                                        <th> Amount  </th><td> {{ $coupon->amount }} </td>
                                    </tr>
                                    <tr>
                                        <th> Expiry Date </th><td> {{ $coupon->expiry_date }} </td>
                                    </tr>
                                    <tr>
                                        <th> Status </th><td> @if($coupon->status==1) {{ 'Active' }} @else {{ 'Inactive' }} @endif </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
