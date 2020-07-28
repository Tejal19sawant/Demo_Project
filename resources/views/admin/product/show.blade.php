@extends('layouts.admin.admin_master')

@section('content')
    <div class="container">
        <div class="row">
           

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Product {{ $product->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/admin/product') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/admin/product/' . $product->id . '/edit') }}" title="Edit category"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('admin/product' . '/' . $product->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete product" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $product->id }}</td>
                                    </tr>
                                    <tr><th> Product Name </th><td> {{ $product->name }} </td></tr>
                                    <tr><th> Category Name </th><td> {{ $category_name->category_name }} </td></tr>
                                    <tr><th> Product Description </th><td> {{ $product->description }} </td></tr>
                                    <tr><th> Code </th><td> {{ $product->code }} </td></tr>
                                    <tr><th> Colour </th><td> {{ $product->colour }} </td></tr>
                                    <tr><th> Price </th><td> {{ $product->price }} </td></tr>
                                    <tr><th> Image </th><td> <img src="{{asset('/public/uploads/products/'.$product_image->image)}}" alt="Not Available"> </td></tr>
                                    <tr><th> Status </th><td> <?php if ($product->status='1'){
                                        echo 'Active';
                                    }
                                    else{
                                        echo 'Inactive';
                                    } ?> 
                                    </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
