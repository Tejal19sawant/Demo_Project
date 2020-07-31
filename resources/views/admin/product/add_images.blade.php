@extends('layouts.admin.admin_master')

@section('content')
    <div class="container">
     <!--------create Attribute starts here------------->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Add Product Images</div>
                    <div class="card-body">
                        <a href="{{ url('/admin/product') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />
                        @if (session('flash_message'))
                            <div class="alert alert-success">
                                {{ session('flash_message') }}
                            </div>
                         @endif
                        <!-- <?php //if($errors->any()){ ?>
                            <ul class="alert alert-danger">
                            <?php //foreach($errors->all() as $error){?> 
                                    <li><?php //echo $error;?></li>
                               <?php //}?>
                            </ul>
                        <?php //}?> -->
                       
                        <form method="POST" action="{{ url('/admin/product/add-images/'.$productDetails->id) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <input type="hidden" name="product_id" value="{{$productDetails->id}}">
                            <div class="form-group {{ $errors->has('product_name') ? 'has-error' : ''}}">
                                <label for="product_name" class="control-label" style="font-weight:bold;">{{ 'Product Name' }}:</label>
                                {{$productDetails->name}}
                            </div>
                            <div class="form-group {{ $errors->has('product_code') ? 'has-error' : ''}}">
                                <label for="product_code" class="control-label" style="font-weight:bold;">{{ 'Product Code' }}:</label>
                                {{$productDetails->code}}
                            </div>
                            <div class="form-group {{ $errors->has('product_color') ? 'has-error' : ''}}">
                                <label for="product_color" class="control-label" style="font-weight:bold;">{{ 'Product Colour' }}:</label>
                                {{$productDetails->colour}}
                            </div>
                                                     
                            <div class="form-group {{ $errors->has('file') ? 'has-error' : ''}}">
                                <label for="file" class="control-label">{{ 'Upload Images' }}</label>
                                <input type="file" name="image[]" id="image" class="form-control" multiple="multiple">
                               
                                {!! $errors->first('image', '<p class="help-block" style="color:red;">:message</p>') !!}
                            </div>

                                
                            

                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" value="Add Image">
                            </div>


                        </form>

                    </div>
                </div>
            </div>
        </div>
        <!--------create Images Ends here------------->

        <!---------------View Images Starts here-------------------->
        <div class="row view_prodattr_row_div">
          
            
           <div class="col-md-12">
           <div class="card">
           <div class="card-header">View & Edit Product Images</div>
           
            <br/>
            <br/>
            <div class="table-responsive">
                <table class="table">
                    
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Product ID</th>
                            <th>Image</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php //print_r($product_images); exit();?>
                       @foreach($product_images as $img)
                        <tr>
                            
                            <td>{{$img->id}}</td>
                            <td>{{$img->product_id}}</td>
                            <td><img src="{{asset('uploads/products/'.$img->image)}}" alt="Not Available" style="width: 150px;"></td>
                            <td>
                            
                               
                            <form method="POST" action="{{ url('/admin/product/delete_attr/' .  $img->id) }}" accept-charset="UTF-8" style="display:inline">
                                {{ method_field('DELETE') }}
                                {{ csrf_field() }}
                                <input type="hidden" name="delete_prod_id" value="">
                                <button type="submit" class="btn btn-danger btn-sm" title="Delete product" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                            </form>
                            </td>
                        </tr>
                       @endforeach
                    </tbody>
                </table>
            <div class="pagination-wrapper"> </div>
            </div>
           </div>
           </div>
        </div>                 

        <!---------------View Images Ends here-------------------->

    </div>
@endsection
