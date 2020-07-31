
<!-- Start Top Search -->
<div class="top-search">
        <div class="container">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-search"></i></span>
                <input type="text" class="form-control" placeholder="Search">
                <span class="input-group-addon close-search"><i class="fa fa-times"></i></span>
            </div>
        </div>
    </div>
    <!-- End Top Search -->

    <!-- Start Slider -->
    <div id="slides-shop" class="cover-slides">
        <ul class="slides-container">
        @foreach($banners as $ban)
            <li class="{{$ban->textstyle}}">
                <img src="{{asset('storage/'.$ban->bannerimage)}}" alt="">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h1 class="m-b-20"><strong>{!!$ban->name!!}</strong></h1>
                            <p class="m-b-40">{!!$ban->content!!}</p>
                            <p><a class="btn hvr-hover" href="{{$ban->link}}">Shop New</a></p>
                        </div>
                    </div>
                </div>
            </li>
        @endforeach
        </ul>
        <div class="slides-navigation">
            <a href="#" class="next"><i class="fa fa-angle-right" aria-hidden="true"></i></a>
            <a href="#" class="prev"><i class="fa fa-angle-left" aria-hidden="true"></i></a>
        </div>
    </div>
    <!-- End Slider -->
