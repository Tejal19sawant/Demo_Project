  <!-- footer content -->
  <footer>
          <div class="pull-right">
            Admin CRM</a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <!-- <script src="{{asset('js/vendors/jquery/dist/jquery.min.js')}}"></script> -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
    <script src="{{asset('js/jquery.min.js')}}"></script>
    
    <!-- Bootstrap -->
    <script src="{{asset('js/vendors/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
    <!-- FastClick -->
    <script src="{{asset('js/vendors/fastclick/lib/fastclick.js')}}"></script>
    <!-- NProgress -->
    <script src="{{asset('js/vendors/nprogress/nprogress.js')}}"></script>
    <!-- Chart.js -->
    <script src="{{asset('js/vendors/Chart.js/dist/Chart.min.js')}}"></script>
   
    <!-- bootstrap-progressbar -->
    <script src="{{asset('js/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js')}}"></script>
    <!-- iCheck -->
    <script src="{{asset('js/vendors/iCheck/icheck.min.js')}}"></script>
    
    <!-- Flot -->
    <script src="{{asset('js/vendors/Flot/jquery.flot.js')}}"></script>
    <script src="{{asset('js/vendors/Flot/jquery.flot.pie.js')}}"></script>
    <script src="{{asset('js/vendors/Flot/jquery.flot.time.js')}}"></script>
    <script src="{{asset('js/vendors/Flot/jquery.flot.stack.js')}}"></script>
    <script src="{{asset('js/vendors/Flot/jquery.flot.resize.js')}}"></script>
    <!-- Flot plugins -->
    <script src="{{asset('js/vendors/flot.orderbars/js/jquery.flot.orderBars.js')}}"></script>
    <script src="{{asset('js/vendors/flot-spline/js/jquery.flot.spline.min.js')}}"></script>
    <script src="{{asset('js/vendors/flot.curvedlines/curvedLines.js')}}"></script>
    <!-- DateJS -->
    <script src="{{asset('js/vendors/DateJS/build/date.js')}}"></script>
    <!-- JQVMap -->
    <script src="{{asset('js/vendors/jqvmap/dist/jquery.vmap.js')}}"></script>
    <script src="{{asset('js/vendors/jqvmap/dist/maps/jquery.vmap.world.js')}}"></script>
    <script src="{{asset('js/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js')}}"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="{{asset('js/vendors/moment/min/moment.min.js')}}"></script>
    <script src="{{asset('js/vendors/bootstrap-daterangepicker/daterangepicker.js')}}"></script>

    <!-- Custom Theme Scripts -->
    <script src="{{asset('js/custom.min.js')}}"></script>


<script>
/********Add/Remove input fields*****************/
//Add Input Fields
$(document).ready(function() {
    var max_fields = 10; //Maximum allowed input fields 
    var wrapper    = $(".wrapper"); //Input fields wrapper
    var add_button = $(".add_fields"); //Add button class or ID
    var x = 1; //Initial input field is set to 1
 
 //When user click on add input button
 $(add_button).click(function(e){
        e.preventDefault();
 //Check maximum allowed input fields
        if(x < max_fields){ 
            x++; //input field increment
 //add input field
            $(wrapper).append('<div style="display:flex;"><input type="text" name="sku[]" id="sku[]" placeholder="SKU" class="form-control" style="width:120px;margin-right:5px;" required/><input type="text" name="size[]" id="size[]" placeholder="Size" class="form-control" style="width:120px;margin-right:5px;" required/><input type="text" name="price[]" id="price[]" placeholder="price" class="form-control" style="width:120px;margin-right:5px;" required/><input type="text" name="stock[]" id="stock[]" placeholder="stock" class="form-control" style="width:120px;margin-right:5px;" required/><a href="javascript:void(0);" class="remove_field">Remove</a></div>');
        }
    });
 
    //when user click on remove button
    $(wrapper).on("click",".remove_field", function(e){ 
        e.preventDefault();
 $(this).parent('div').remove(); //remove inout field
 x--; //inout field decrement
    })
});
/********Add/Remove input fields*****************/
</script>
<script>
    // $(document).ready(function(){
    //    //alert();
    //   var url = $(location).attr('href'),
    //   parts = url.split("/"),
    //   last_part = parts[parts.length-2];
    //   //alert(last_part);

    //   if(pageURL="users")
    //   { //alert('yes');
    //     $("ul.side-menu li:first").addClass("current-page");
    //   }
      
       
    // });
</script>
	
  </body>
</html>
