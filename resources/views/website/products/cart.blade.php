@extends('layouts.website.master_without_banner')

@section('content')
  <!-- Start Cart  -->
  <div class="cart-box-main">
                    @if (session('flash_message'))
                        <div class="alert alert-success">
                            {{ session('flash_message') }}
                        </div>
                    @endif
                    @if (session('flash_message_error'))
                        <div class="alert alert-danger">
                            {{ session('flash_message_error') }}
                        </div>
                    @endif
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-main table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Images</th>
                                    <th>Product Name</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th>Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $total_amount=0;?>
                                @foreach($userCart as $cart)
                                <tr>
                                    <td class="thumbnail-img">
                                        <a href="#">
									<img class="img-fluid" src="{{asset('uploads/products/'.$cart->image)}}" alt="Not Available" />
								</a>
                                    </td>
                                    <td class="name-pr">
                                        
									{{$cart->product_name}}
                                    <p>{{$cart->product_code}} | {{$cart->size}}</p>
                                    </td>
                                    <td class="price-pr">
                                        <p>Rs {{$cart->price}}</p>
                                    </td>
                                    <td class="quantity-box">
                                        <a href="{{url('/cart/update-quantity/'.$cart->id.'/1')}}" style="font-size:25px;">+</a>
                                            <input type="text" size="4" value="{{$cart->quantity}}" min="0" step="1" class="c-input-text qty text">
                                        @if($cart->quantity>1)
                                        <a href="{{url('/cart/update-quantity/'.$cart->id.'/-1')}}" style="font-size:25px;">-</a>
                                        @endif
                                    </td>
                                    <td class="total-pr">
                                        <p>Total Price: {{$cart->price*$cart->quantity}}</p>
                                    </td>
                                    <td class="remove-pr">
                                        <a href="{{url('/cart/delete-product/'.$cart->id)}}">
									<i class="fas fa-times"></i>
								</a>
                                    </td>
                                </tr>
                                <?php $total_amount = $total_amount+($cart->price*$cart->quantity);?>
                                @endforeach
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="row my-5">
                <div class="col-lg-6 col-sm-6">
                    <div class="coupon-box">
                        <form action="{{url('/cart/apply-coupon')}}" method="post">
                        {{csrf_field() }}
                        <div class="input-group input-group-sm">
                            <input class="form-control" placeholder="Enter your coupon code" name="coupon_code" aria-label="Coupon code" type="text">
                            <div class="input-group-append">
                                <button class="btn btn-theme" type="submit">Apply Coupon</button>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-6">
                    <div class="order-box">
                        <h3>Order summary</h3>
                        @if(!empty(Session::get('CouponAmount')))
                        <div class="d-flex">
                            <h4>Sub Total</h4>
                            <div class="ml-auto font-weight-bold"> Rs <?php echo $total_amount;?> </div>
                        </div>
                       
                        <hr class="my-1">
                        <div class="d-flex">
                            <h4>Coupon Discount</h4>
                            <div class="ml-auto font-weight-bold"> Rs <?php echo Session::get('CouponAmount');?> </div>
                        </div>
                        <hr>
                        <div class="d-flex gr-total">
                            <h5>Grand Total</h5>
                            <div class="ml-auto h5"> Rs  <?php echo $total_amount - Session::get('CouponAmount');?> </div>
                        </div>
                        
                        <hr>
                        @else
                        <div class="d-flex gr-total">
                            <h5>Grand Total</h5>
                            <div class="ml-auto h5"> Rs  <?php echo $total_amount; ?> </div>
                        </div>
                        @endif
                        
                    </div>
                    <div class="col-12 d-flex shopping-box"><a href="{{url('/checkout')}}" class="ml-auto btn hvr-hover">Checkout</a> </div>
                </div>
            </div>


        </div>
    </div>
    <!-- End Cart -->


@endsection