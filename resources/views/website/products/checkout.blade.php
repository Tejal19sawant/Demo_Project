@extends('layouts.website.master_without_banner')

@section('content')


<div class="contact-box-main">
    <div class="container">
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

    <form action="{{url('/checkout')}}" method="post" id="contactForm1">
        {{csrf_field()}}
        <div class="row">
            <div class="col-lg-6 col-sm-12">
                <div class="contact-form-right">

                    <h2>Bill To !</h2>
                    
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" value="{{$userDetails->name}}" id="billing_name" name="billing_name" required data-error="Please Enter Your  Name">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" value="{{$userDetails->address}}" id="billing_address" name="billing_address" required data-error="Please Enter Your Billing Address">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" value="{{$userDetails->city}}" id="billing_city" name="billing_city" required data-error="Please Enter Your City">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" value="{{$userDetails->state}}" id="billing_state" name="billing_state" required data-error="Please Enter Your State">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <select class="form-control" id="billing_country" name="billing_country">
                                    <option value="1">Select country</option>
                                    @foreach($country as $ct)
                                    <option value="{{$ct->name}}"  @if($ct->name == $userDetails->country) selected @endif>{{$ct->name}}</option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" value="{{$userDetails->pincode}}" id="billing_pincode" name="billing_pincode" required data-error="Please Enter Your Pincode">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" value="{{$userDetails->mobile}}" id="billing_mobile" name="billing_mobile" required data-error="Please Enter Your Mobile">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group" style="margin-left:30px;">
                                    <input type="checkbox" class="form-check-input"  id="billtoship">
                                    <label class="form-check-label" for="billtoship">Shipping Address Same As Billing Address</label>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            

                        </div>
                   
                </div>
            </div>

           
            <div class="col-lg-6 col-sm-12">
            <div class="contact-form-right">
                    <h2>Ship To !</h2>
                    
                    <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" value="{{$shippingDetails->name}}" id="shipping_name" name="shipping_name" required data-error="Please Enter Your  Name">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" value="{{$shippingDetails->address}}" id="shipping_address" name="shipping_address" required data-error="Please Enter Your Billing Address">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" value="{{$shippingDetails->city}}" id="shipping_city" name="shipping_city" required data-error="Please Enter Your City">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" value="{{$shippingDetails->state}}" id="shipping_state" name="shipping_state" required data-error="Please Enter Your State">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <select class="form-control" id="shipping_country" name="shipping_country">
                                    <option value="1">Select country</option>
                                    @foreach($country as $ct)
                                    <option value="{{$ct->name}}"   @if($ct->name == $userDetails->country) selected @endif>{{$ct->name}}</option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" value="{{$shippingDetails->pincode}}" id="shipping_pincode" name="shipping_pincode" required data-error="Please Enter Your Pincode">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" value="{{$shippingDetails->mobile}}" id="shipping_mobile" name="shipping_mobile" required data-error="Please Enter Your Mobile">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="submit-button text-center">
                                <button class="btn hvr-hover" id="submit" type="submit">Checkout</button>
                                <div id="msgSubmit" class="h3 text-center hidden"></div>
                                <div class="clearfix"></div>
                                </div>
                            </div>

                    </div>
                   
                </div>        
            </div>


        </div>
    </form>    
    </div>
</div>


@endsection