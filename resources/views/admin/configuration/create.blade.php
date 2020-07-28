@extends('layouts.admin.admin_master')

@section('content')
    <div class="container">
        <div class="row">
           

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Create New configuration</div>
                    <div class="card-body">
                        <a href="{{ url('/admin/configuration') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />

                    
                        <!-- <?php //if($errors->any()){ ?>
                            <ul class="alert alert-danger">
                               <?php //foreach($errors->all() as $error){?> 
                                    <li><?php //echo $error;?></li>
                               <?php //}?>
                            </ul>
                        <?php //}?> -->

                        <form method="POST" action="{{ url('/admin/configuration') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            @include ('admin.configuration.form', ['formMode' => 'create'])

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
