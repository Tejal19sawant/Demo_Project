<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="images/favicon.ico" type="image/ico" />

    <title>Admin</title>
    
    <!-- Bootstrap -->
    <link href="{{asset('css/vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{asset('css/vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <!-- NProgress -->
    <!-- <link href="{{asset('css/vendors/nprogress/nprogress.css')}}" rel="stylesheet"> -->
    <!-- iCheck -->
    <link href="{{asset('css/vendors/iCheck/skins/flat/green.css')}}" rel="stylesheet">
	
    <!-- bootstrap-progressbar -->
    <link href="{{asset('css/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css')}}" rel="stylesheet">
    <!-- JQVMap -->
    <link href="{{asset('css/vendors/jqvmap/dist/jqvmap.min.css')}}" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="{{asset('css/vendors/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{asset('css/custom.min.css')}}" rel="stylesheet">

    <!---------My Css----------->
    <link href="{{asset('css/my_css.css')}}" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet"/>
  </head>
  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="/home" class="site_title"><img src="{{asset('images/admin_images/admin_crm_logo.png')}}" alt="Not Available" style="height: inherit;"> <span>CRM Admin</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <!-- <div class="profile_pic">
                <img src="{{asset('images/img.jpg')}}" alt="..." class="img-circle profile_img">
              </div> -->
              <div class="profile_info">
                <!-- <span>Welcome,</span> -->
                <h2> Welcome, {{ ucfirst(trans(Auth::user()->name)) }} </h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li><a href="/admin/users"><i class="fa fa-user-plus" aria-hidden="true"></i> Users Management </a>
                  </li>
                  <li><a href="/admin/configuration"><i class="fa fa-edit"></i> Configuration Management </a>
                    <!-- <ul class="nav child_menu">
                      <li><a href="form.html">General Form</a></li>
                    </ul> -->
                  </li>
                  <li><a href="/admin/category"><i class="fa fa-list-alt" aria-hidden="true"></i> Category Management </a>
                  </li>
                  <li><a href="/admin/product"><i class="fa fa-product-hunt" aria-hidden="true"></i> Product Management </a>
                  </li>
                  <li><a href="/admin/banners"><i class="fa fa-file-image-o" aria-hidden="true"></i> Banners Management </a>
                  </li>
                 
                </ul>
              </div>
             

            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <!-- <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="/login">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div> -->
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>
              <nav class="nav navbar-nav">
              <ul class=" navbar-right">
                <li class="nav-item dropdown">
                  <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                  </a>

                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                      <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                      </a>

                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                      </form>
                  </div>
                </li>

                <li role="presentation" class="nav-item dropdown open">
                  
                  <ul class="dropdown-menu list-unstyled msg_list" role="menu" aria-labelledby="navbarDropdown1">
                    <li class="nav-item">
                      <a class="dropdown-item">
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="dropdown-item">
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="dropdown-item">
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="dropdown-item">
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <div class="text-center">
                        <a class="dropdown-item">
                          <strong>See All Alerts</strong>
                          <i class="fa fa-angle-right"></i>
                        </a>
                      </div>
                    </li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

       

