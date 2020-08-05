@extends('layouts.website.master_without_banner')

@section('content')
<!-- Start All Title Box -->
<div class="all-title-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Product Detail</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Shop</a></li>
                        <li class="breadcrumb-item active">{{$prod_detls->name}} </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End All Title Box -->
 <!-- Start Shop Detail  -->
 <div class="shop-detail-box-main">
        <div class="container">
            <div class="row">
                <div class="col-xl-5 col-lg-5 col-md-6">
                    <div id="carousel-example-1" class="single-product-slider carousel slide" data-ride="carousel">
                        <div class="carousel-inner" role="listbox">
                            
                                @foreach($productAltImages as $key=>$images)
                                <div class="carousel-item {{$key==0 ? 'active' : ''}} "> <img class="d-block w-100" src="{{asset('uploads/products/'.$images->image)}}" alt="First slide"> </div>
                                
                                @endforeach
                           
                        </div>
                        <a class="carousel-control-prev" href="#carousel-example-1" role="button" data-slide="prev"> 
						<i class="fa fa-angle-left" aria-hidden="true"></i>
						<span class="sr-only">Previous</span> 
					</a>
                        <a class="carousel-control-next" href="#carousel-example-1" role="button" data-slide="next"> 
						<i class="fa fa-angle-right" aria-hidden="true"></i> 
						<span class="sr-only">Next</span> 
					</a>
                        <ol class="carousel-indicators">
                        @foreach($productAltImages as $key=>$images)
                            <li data-target="#carousel-example-1" data-slide-to="{{$key}}" class="{{$key==0 ? 'active' : ''}}">
                                <img class="d-block w-100 img-fluid" src="{{asset('uploads/products/'.$images->image)}}" alt="" />
                            </li>
                        @endforeach
                            
                        </ol>
                    </div>
                </div>
                <div class="col-xl-7 col-lg-7 col-md-6">
                    <form name="addtoCart" method="post" action="{{url('/add-cart')}}">
                    {{csrf_field()}}
                    <div class="single-product-details">
                        <input type="hidden" value="{{$prod_detls->id}}" name="product_id">
                        <input type="hidden" value="{{$prod_detls->name}}" name="product_name">
                        <input type="hidden" value="{{$prod_detls->code}}" name="product_code">
                        <input type="hidden" value="{{$prod_detls->colour}}" name="product_colour">
                        <input type="hidden" id="price" value="{{$prod_detls->price}}" name="product_price">
                        
                        <h2>Product Name: {{$prod_detls->name}}</h2>
                        <h5 id="getPrice">Product Price: Rs {{$prod_detls->price}}</h5>
                       
                            <p>
                                <h4>Short Description:</h4>
                                <p>{{$prod_detls->description}} </p>
                                <ul>
                                    <li>
                                        <div class="form-group size-st">
                                            <label class="size-label">Size</label>
                                            <select id="selSize" name="size" class="selectpicker show-tick form-control">
									<option value="0">Size</option>
									@foreach($prod_detls->attributes as $proattr)
                                    <option value="{{$prod_detls->id}}-{{$proattr->size}}">{{$proattr->size}}</option>
                                    @endforeach
								</select>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-group quantity-box">
                                            <label class="control-label">Quantity</label>
                                            <input class="form-control" name="quantity" value="0" min="0" max="20" type="number">
                                        </div>
                                    </li>
                                </ul>

                                <div class="price-box-bar">
                                    <div class="cart-and-bay-btn">
                                        <button class="btn hvr-hover" data-fancybox-close="" type="submit" style="color:white;">Add to cart</button>
                                    </div>
                                </div>

                                <div class="add-to-btn">
                                    <div class="add-comp">
                                        <a class="btn hvr-hover" href="#"><i class="fas fa-heart"></i> Add to wishlist</a>
                                        <a class="btn hvr-hover" href="#"><i class="fas fa-sync-alt"></i> Add to Compare</a>
                                    </div>
                                    <div class="share-bar">
                                        <a class="btn hvr-hover" href="#"><i class="fab fa-facebook" aria-hidden="true"></i></a>
                                        <a class="btn hvr-hover" href="#"><i class="fab fa-google-plus" aria-hidden="true"></i></a>
                                        <a class="btn hvr-hover" href="#"><i class="fab fa-twitter" aria-hidden="true"></i></a>
                                        <a class="btn hvr-hover" href="#"><i class="fab fa-pinterest-p" aria-hidden="true"></i></a>
                                        <a class="btn hvr-hover" href="#"><i class="fab fa-whatsapp" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                    </div>
                    </form>
                </div>
            </div>

            <div class="row my-5">
                <div class="col-lg-12">
                    <div class="title-all text-center">
                        <h1>Featured Products</h1>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed sit amet lacus enim.</p>
                    </div>
                    <div class="featured-products-box owl-carousel owl-theme">
                    @foreach($featuredProducts as $fp)
                        <div class="item">
                            <div class="products-single fix">
                                <div class="box-img-hover">
                                    <img src="{{asset('uploads/products/'.$fp->image)}}" class="img-fluid" alt="Image">
                                    <div class="mask-icon">
                                        <ul>
                                            <li><a href="#" data-toggle="tooltip" data-placement="right" title="View"><i class="fas fa-eye"></i></a></li>
                                            <li><a href="#" data-toggle="tooltip" data-placement="right" title="Compare"><i class="fas fa-sync-alt"></i></a></li>
                                            <li><a href="#" data-toggle="tooltip" data-placement="right" title="Add to Wishlist"><i class="far fa-heart"></i></a></li>
                                        </ul>
                                        <a class="cart" href="#">Add to Cart</a>
                                    </div>
                                </div>
                                <div class="why-text">
                                    <h4>{{$fp->name}}</h4>
                                    <h5> {{$fp->price}}</h5>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- End Cart -->
@endsection