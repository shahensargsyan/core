<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link type="text/css" rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('css/chosen.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('css/slim.min.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('css/admin/styles.css') }}">
    <link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans" >
    <link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" >
    <style> 
    	.copyright {
	    display: none
	}
	.logo {
	    margin-left: 34px;
	}
	.catergory-place {
	    margin-top: 30px;
	}
	.sidebar-nav {
	   padding-top: 0;  
	}
	.sidebar-nav li {
	    padding: 10px 5px 9px 36px;
	}
	.sidebar-nav a {
	    font-size: 14px; 
	}
    </style>
    <script src="{{ asset('lib/ckeditor/ckeditor.js') }}"></script>
</head>
<body>
    <div id="app" v-cloak="">
        <header class="MAIN-FIX-TOP">
            <div class="MAIN-FIX-TOP-FIX">
                <div class="main-fix-top-fix-pad">
                    <div class="top-menu-place">
                        <!-- Collapsed Hamburger -->
                        <div type="button" class="sidebar-toggle">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </div>
                        <ul class="nav navbar-nav navbar-right">
                                        <!-- Authentication Links -->
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->first_name . " " . Auth::user()->last_name }}
                                    <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </header>
        <div class="MAIN-CARCASS">
            <div class="MAIN-FIX-CARCASS">
                <div class="MAIN-FIX-LEFT">
                    <div class="LEFT-BAR-SCROLL-PLACE">
                        <div class="LEFT-BAR-pad">
                            <div>
                                <a href="{{ env('SITE_URL') }}" target="_blank"><div class="logo"></div></a>
                            </div>
                            <div class="catergory-place">
                            
                                @if(Auth::user())
                                    <ul class="sidebar-nav">
                                        @if(Auth::user()->role == 'admin')                                       
                                            <li class="{{ Request::is('products') || Request::is('products/*') ? 'active-menu-sidebar' : '' }}">
                                                <a href="/products">
                                                    Products
                                                </a>
                                            </li>
                                            <li class="{{ Request::is('fuel_types') || Request::is('fuel_types/*') ? 'active-menu-sidebar' : '' }}">
                                                <a href="/fuel_types">
                                                    Fuel types
                                                </a>
                                            </li>
                                            <li class="{{ Request::is('fireplace_types') || Request::is('fireplace_types/*') ? 'active-menu-sidebar' : '' }}">
                                                <a href="/fireplace_types">
                                                    Fireplace types
                                                </a>
                                            </li>
                                            <li class="{{ Request::is('priceRanges') || Request::is('priceRanges/*') ? 'active-menu-sidebar' : '' }}">
                                                <a href="/priceRanges">
                                                    Price Ranges
                                                </a>
                                            </li>
                                            <li class="{{ Request::is('heatOutputRanges') || Request::is('heatOutputRanges/*') ? 'active-menu-sidebar' : '' }}">
                                                <a href="/heatOutputRanges">
                                                    Heat Output Ranges
                                                </a>
                                            </li>
                                            <li class="{{ Request::is('fireplaceSizeRanges') || Request::is('fireplaceSizeRanges/*') ? 'active-menu-sidebar' : '' }}">
                                                <a href="/fireplaceSizeRanges">
                                                    Fireplace Size Ranges
                                                </a>
                                            </li>
                                            <li class="{{ Request::is('sliders') || Request::is('sliders/*') ? 'active-menu-sidebar' : '' }}">
                                                <a href="/sliders">
                                                    Sliders
                                                </a>
                                            </li>
                                            <li class="{{ Request::is('galleries') || Request::is('galleries/*') ? 'active-menu-sidebar' : '' }}">
                                                <a href="/galleries">
                                                    Gallery
                                                </a>
                                            </li>
                                            <li class="{{ Request::is('services') || Request::is('services/*') ? 'active-menu-sidebar' : '' }}">
                                                <a href="/services">
                                                    Services	
                                                </a>
                                            </li>
                                            <li class="{{ Request::is('testimonials') || Request::is('testimonials/*') ? 'active-menu-sidebar' : '' }}">
                                                <a href="/testimonials">
                                                    Testimonials	
                                                </a>
                                            </li>
                                            <li class="{{ Request::is('custom_information') || Request::is('custom_information/*') ? 'active-menu-sidebar' : '' }}">
                                                <a href="/custom_information">
                                                    Custom Information
                                                </a>
                                            </li>
                                            <li class="{{ Request::is('subscribers') || Request::is('subscribers/*') ? 'active-menu-sidebar' : '' }}">
                                                <a href="/subscribers">
                                                    Subscribers
                                                </a>
                                            </li>
                                        @endif
                                    </ul>
                                @endif

                            </div>
                        </div>
                        <p class="copyright">
                            Copyright 2017 © CoreFireplace.com All Rights Reserved
                        </p>
                    </div>
                </div>
                <div class="MAIN-FIX-CARCASS-PAD">
                    <div class="MAIN-FIX-CENTER">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/moment.min.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/chosen.jquery.js') }}"></script>
    <script src="{{ asset('js/admin.js') }}"></script>
    <script src="{{ asset('js/slim.kickstart.min.js') }}"></script>
    
    <script src="{{ asset('js/scripts.js') }}"></script>
    <script src="{{ asset('js/bootstrap.js') }}"></script>
    

    
    
    @if(explode('/', Request::path())[0] && file_exists("js/" . explode('/', Request::path())[0] . ".js"))
        <script src="{{ asset('js/' . (explode('/', Request::path())[0]) . '.js?v=' . date('YmdH')) }}"></script>
	@endif
</body>
</html>
