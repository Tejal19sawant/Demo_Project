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
                    <form action="{{url('/change-password')}}" method="post" id="contactForm1">
                    {{csrf_field()}}
                        <div class="row">
                            
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="hidden" class="form-control" placeholder="Old Password" id="old_pwd" name="old_pwd" required data-error="Please Enter Your Old password">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="password" class="form-control" placeholder="Old Password" id="current_pwd" name="current_pwd" required data-error="Please Enter Your Old password">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="password" class="form-control" placeholder="New Password" id="new_password" name="new_password" required data-error="Please Enter Your  New Password">
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