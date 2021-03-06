@extends('layouts.admin.admin_master')

@section('content')
    <div class="container">
        <div class="row">
           
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Create New user</div>
                    <div class="card-body">
                        <a href="{{ url('/admin/users') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />

                         <!-- <?php //if($errors->any()){ ?>
                            <ul class="alert alert-danger">
                            <?php //foreach($errors->all() as $error){?> 
                                    <li><?php //echo $error;?></li>
                               <?php //}?>
                            </ul>
                        <?php //}?> -->

                        <form method="POST" action="{{ url('/admin/users') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            @include ('admin.users.form', ['formMode' => 'create'])

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
