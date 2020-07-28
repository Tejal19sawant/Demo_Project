@extends('layouts.admin.admin_master')

@section('content')
    <div class="container">
     <!--------create Attribute starts here------------->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Create New Product Attribute</div>
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
                       
                        <form method="POST" action="{{ url('/admin/product/storeatt/'.$product_detls[0]['id']) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            
                            <div class="form-group {{ $errors->has('product_name') ? 'has-error' : ''}}">
                                <label for="product_name" class="control-label" style="font-weight:bold;">{{ 'Product Name' }}:</label>
                                {{$product_detls[0]['name']}}
                            </div>
                            <div class="form-group {{ $errors->has('product_code') ? 'has-error' : ''}}">
                                <label for="product_code" class="control-label" style="font-weight:bold;">{{ 'Product Code' }}:</label>
                                {{$product_detls[0]['code']}}
                            </div>
                            <div class="form-group {{ $errors->has('product_color') ? 'has-error' : ''}}">
                                <label for="product_color" class="control-label" style="font-weight:bold;">{{ 'Product Colour' }}:</label>
                                {{$product_detls[0]['colour']}}
                            </div>
                                                     
                            <div class="form-group wrapper">
                                <div style="display:flex;">
                                <input type="text" name="sku[]" id="sku[]" value="{{old('sku[]')}}" placeholder="SKU" class="form-control" style="width:120px;margin-right:5px;" required/>
                                {!! $errors->first('sku', '<p class="help-block" style="color:red;">:message</p>') !!}
                                <input type="text" name="size[]" id="size[]" placeholder="Size" class="form-control" style="width:120px;margin-right:5px;" required/>
                                {!! $errors->first('size', '<p class="help-block" style="color:red;">:message</p>') !!}
                                <input type="text" name="price[]" id="price[]" placeholder="Price" class="form-control" style="width:120px;margin-right:5px;" required/>
                                {!! $errors->first('price', '<p class="help-block" style="color:red;">:message</p>') !!}
                                <input type="text" name="stock[]" id="stock[]" placeholder="Stock" class="form-control" style="width:120px;margin-right:5px;" required/>
                                {!! $errors->first('stock', '<p class="help-block" style="color:red;">:message</p>') !!}
                                <a href="javascript:void(0)" class="add_fields" title="Add More Fields">ADD</a>
                                </div>
                            </div>
                                
                            

                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" value="Add Attributes">
                            </div>


                        </form>

                    </div>
                </div>
            </div>
        </div>
        <!--------create Attribute Ends here------------->

        <!---------------View Attribute Starts here-------------------->
        <div class="row view_prodattr_row_div">
           <?php //print_r($product_detls); 
          // print_r($a[0]['attributes']);
        //    foreach ($product_detls[0]['attributes'] as $attr){
        //       print_r($attr['sku']);
        //    }
        // exit();?>
            
           <div class="col-md-12">
           <div class="card">
           <div class="card-header">View & Edit Product Attribute</div>
            <!-- <form method="GET" action="{{ url('/admin/product/attributes/'.$product_detls[0]['id']) }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
               <div class="input-group prodattr_frm_search">
                   <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}">
                   <span class="input-group-append">
                       <button class="btn btn-secondary" type="submit">
                           <i class="fa fa-search"></i>
                       </button>
                   </span>
               </div>
            </form>    -->
            <br/>
            <br/>
            <div class="table-responsive">
                <table class="table">
                    
                    <thead>
                        <tr>
                            
                            <th>Category ID</th>
                            <th>Product ID</th>
                            <th>SKU</th>
                            <th>Size</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                       @foreach($product_detls[0]['attributes'] as $attr)
                        <tr>
                            
                            <td>{{$product_detls[0]['category_id']}}</td>
                            <td>{{$attr['product_id']}}</td>
                                <form method="POST" action="{{ url('/admin/product/edit-attributes/'.$attr['id']) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                                {{ method_field('POST') }}
                                {{ csrf_field() }}
                                <input type="hidden" name="product_id" value="{{$product_detls[0]['id']}}">
                                <td><input type="text" name="sku[]"  value="{{$attr['sku']}}" required></td>
                                <td><input type="text" name="size[]" value="{{$attr['size']}}" required></td>
                                <td><input type="text" name="price[]" value="{{$attr['price']}}" required></td>
                                <td><input type="text" name="stock[]" value="{{$attr['stock']}}" required></td>
                            
                            <td>
                            <input class="btn btn-primary btn-sm" type="submit" value="Update">
                                </form>
                            <form method="POST" action="{{ url('/admin/product/delete_attr/' .  $attr['id']) }}" accept-charset="UTF-8" style="display:inline">
                                {{ method_field('DELETE') }}
                                {{ csrf_field() }}
                                <input type="hidden" name="delete_prod_id" value="{{$attr['product_id']}}">
                                <button type="submit" class="btn btn-danger btn-sm" title="Delete product" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                            </form>
                            </td>
                        </tr>
                       @endforeach
                    </tbody>
                </table>
            <div class="pagination-wrapper"> {!! $product_detls_pagination->appends(['search' => Request::get('search')])->render() !!} </div>
            </div>
           </div>
           </div>
        </div>                 

        <!---------------View Attribute Ends here-------------------->
    </div>
@endsection
