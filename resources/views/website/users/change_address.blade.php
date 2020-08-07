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
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6 ">
                <div class="contact-form-right">

                    <h2>Change Password !</h2>
                    <form action="{{url('/change-address')}}" method="post" id="contactForm1">
                    {{csrf_field()}}
                        <div class="row">
                            
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" value="{{$userDetails->name}}" id="name" name="name" required data-error="Please Enter Your Name">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" value="{{$userDetails->address}}" id="address" name="address" required data-error="Please Enter Your Address">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" value="{{$userDetails->city}}" id="city" name="city" required data-error="Please Enter City">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>


                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" value="{{$userDetails->state}}" id="state" name="state" required data-error="Please Enter State">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>


                            <div class="col-md-12">
                                <div class="form-group">
                                    <select name="country" id="country" class="form-control">
                                        <option value="1">Select Country</option>
                                        @foreach($countries as $ct)
                                        <option value="{{$ct->name}}" @if($ct->name == $userDetails->country) selected @endif>{{$ct->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" value="{{$userDetails->pincode}}" id="pincode" name="pincode" required data-error="Please Enter Your Pincode">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" value="{{$userDetails->mobile}}" id="mobile" name="mobile" required data-error="Please Enter Your Mobile No.">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>


                            <div class="col-md-12">
                                <div class="submit-button text-center">
                                <button class="btn hvr-hover" id="submit" type="submit">Save</button>
                                <div id="msgSubmit" class="h3 text-center hidden"></div>
                                <div class="clearfix"></div>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-3"></div>
            
        </div>
    </div>
</div>

@endsection