    <!-- Start Footer  -->
    <footer>
        <div class="footer-main">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="footer-widget">
                            <h4>About ThewayShop</h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                                </p>
                            <ul>
                                <li><a href="#"><i class="fab fa-facebook" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fab fa-twitter" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fab fa-linkedin" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fab fa-google-plus" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-rss" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fab fa-pinterest-p" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fab fa-whatsapp" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="footer-link">
                            <h4>Information</h4>
                            <ul>
                                <li><a href="#">About Us</a></li>
                                <li><a href="#">Customer Service</a></li>
                                <li><a href="#">Our Sitemap</a></li>
                                <li><a href="#">Terms &amp; Conditions</a></li>
                                <li><a href="#">Privacy Policy</a></li>
                                <li><a href="#">Delivery Information</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="footer-link-contact">
                            <h4>Contact Us</h4>
                            <ul>
                                <li>
                                    <p><i class="fas fa-map-marker-alt"></i>Address: Michael I. Days 3756 <br>Preston Street Wichita,<br> KS 67213 </p>
                                </li>
                                <li>
                                    <p><i class="fas fa-phone-square"></i>Phone: <a href="tel:+1-888705770">+1-888 705 770</a></p>
                                </li>
                                <li>
                                    <p><i class="fas fa-envelope"></i>Email: <a href="mailto:contactinfo@gmail.com">contactinfo@gmail.com</a></p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- End Footer  -->

    <!-- Start copyright  -->
    <div class="footer-copyright">
        <p class="footer-company">All Rights Reserved. &copy; 2018 <a href="#">ThewayShop</a> Design By :
            <a href="https://html.design/">html design</a></p>
    </div>
    <!-- End copyright  -->
    <script src="{{asset('js/website_js/kit_fontawesome.js')}}"></script>

    <a href="#" id="back-to-top" title="Back to top" style="display: none;">&uarr;</a>

    <!-- ALL JS FILES -->
    <script src="{{asset('js/website_js/jquery-3.2.1.min.js')}}"></script>
    <script src="{{asset('js/website_js/popper.min.js')}}"></script>
    <script src="{{asset('js/website_js/bootstrap.min.js')}}"></script>
    <!-- ALL PLUGINS -->
    <script src="{{asset('js/website_js/jquery.superslides.min.js')}}"></script>
    <script src="{{asset('js/website_js/bootstrap-select.js')}}"></script>
    <script src="{{asset('js/website_js/inewsticker.js')}}"></script>
    <script src="{{asset('js/website_js/bootsnav.js')}}"></script>
    <script src="{{asset('js/website_js/images-loded.min.js')}}"></script>
    <script src="{{asset('js/website_js/isotope.min.js')}}"></script>
    <script src="{{asset('js/website_js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('js/website_js/baguetteBox.min.js')}}"></script>
    <script src="{{asset('js/website_js/form-validator.min.js')}}"></script>
    <script src="{{asset('js/website_js/contact-form-script.js')}}"></script>
    <script src="{{asset('js/website_js/jquery.nicescroll.min.js')}}"></script>
    <script src="{{asset('js/website_js/custom.js')}}"></script>
    

    <script>
    /*******getting every indivisual product detail price on changing size**********/
    $(document).ready(function(){
        // alert();
        $("#selSize").change(function(){
            // alert();
            var idSize = $(this).val();
            if(idSize==""){
                return false;
            }
            $.ajax({
                type : 'get',
                url : '/get-product-price',
                data : {idSize:idSize},
                success:function(result){
                    //alert(result);
                    var arr = result.split('#');
                    $('#getPrice').html("Product Price: Rs "+arr[0]);
                    $('#price').val(arr[0]);
                },error:function(){
                    alert("Error");
                }
            });
        });
    });
    /*******getting every indivisual product detail price on changing size**********/

                            
   
    </script>
</body>

</html>