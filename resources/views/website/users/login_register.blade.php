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
            <div class="col-lg-5 col-sm-12">
                <div class="contact-form-right">

                    <h2>New User SignUp !</h2>
                    <form action="{{url('/user-register')}}" method="post" id="contactForm1">
                    {{csrf_field()}}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Your Name" id="name" name="name" required data-error="Please Enter Your Name">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Your EmailID" id="email" name="email" required data-error="Please Enter Your EmailID">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="password" class="form-control" placeholder="Your Password" id="password" name="password" required data-error="Please Enter Your Password">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="submit-button text-center">
                                <button class="btn hvr-hover" id="submit" type="submit">SignUp</button>
                                <div id="msgSubmit" class="h3 text-center hidden"></div>
                                <div class="clearfix"></div>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>

            <div class="col-lg-1 col-sm-12" id="or">
                OR
            </div>
            <div class="col-lg-6 col-sm-12">
            <div class="contact-form-right">
                    <h2>Already a Member ? Just SignUp !</h2>
                    <form action="{{url('/user-login')}}" method="post" id="contactForm2">
                    {{csrf_field()}}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Your EmailID" id="email" name="email" required data-error="Please Enter Your EmailID">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="password" class="form-control" placeholder="Your Password" id="password" name="password" required data-error="Please Enter Your Password">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="submit-button text-center">
                                <button class="btn hvr-hover" id="submit" type="submit">Login</button>
                                <div id="msgSubmit" class="h3 text-center hidden"></div>
                                <div class="clearfix"></div>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>            
            </div>


        </div>
    </div>
</div>

@endsection