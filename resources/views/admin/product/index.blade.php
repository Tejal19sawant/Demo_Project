@extends('layouts.admin.admin_master')

@section('content')
    <div class="container">
        <div class="row">
           

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Product</div>
                    <div class="card-body">
                    @if (session('flash_message'))
                        <div class="alert alert-success">
                            {{ session('flash_message') }}
                        </div>
                    @endif
                        <a href="{{ url('/admin/product/create') }}" class="btn btn-success btn-sm" title="Add New category">
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
                                        <th>Product Name</th>
                                        <th>Product Code</th>
                                        <th>Product Colour</th>
                                        <th>Product Description</th>
                                        <th>Product Price</th>
                                        <th>Product Image</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php //print_r($product);?>
                                <?php $i = 1;?>
                                @foreach($product as $item)
                                   
                                   
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{$item->name}}</td>
                                        <td>{{$item->code}}</td>
                                        <td>{{$item->colour}}</td>
                                        <td>{{$item->description}}</td>
                                        <td>{{$item->price}}</td>
                                        <td><img src="{{asset('uploads/products/'.$item->image)}}" style="width: 240px;"></td>
                                        <td><?php if ($item->status='1'){
                                        echo 'Active';
                                    }
                                    else{
                                        echo 'Inactive';
                                    } ?> </td>
                                        <td>
                                        <a href="{{ url('/admin/product/attributes/' . $item->id) }}" title="Attributes product"><button class="btn btn-info btn-sm"><i class="fa fa-bars" aria-hidden="true"></i> Attributes</button></a>
                                        <a href="{{ url('/admin/product/add-images/' . $item->id) }}" title="Add product Images"><button class="btn btn-warning btn-sm"><i class="fa fa-image" aria-hidden="true"></i> Images</button></a>
                                            <a href="{{ url('/admin/product/' . $item->id) }}" title="View product"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                            <a href="{{ url('/admin/product/' . $item->id . '/edit') }}" title="Edit product"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                                            <form method="POST" action="{{ url('/admin/product' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete product" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                    <?php  $i++;?>
                                   
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $product->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
