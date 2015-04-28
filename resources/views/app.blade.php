<!DOCTYPE html>
    <!--[if IE 9 ]><html class="ie9"><![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Material Admin</title>
        
        <!-- Vendor CSS -->
        <link href="/theme/Template/vendors/animate-css/animate.min.css" rel="stylesheet">

        <!-- CSS -->
        <link href="/theme/Template/css/app.css" rel="stylesheet">
        
    </head>
    
    <body>
        <header id="header">
            <ul class="header-inner">
                <li id="menu-trigger" data-trigger="#sidebar">
                    <div class="line-wrap">
                        <div class="line top"></div>
                        <div class="line center"></div>
                        <div class="line bottom"></div>
                    </div>
                </li>
            
                <li class="logo hidden-xs">
                    <a href="index.html">Atomic Burger Admin</a>
                </li>

            </ul>
        </header>
        
        <section id="main">
            <aside id="sidebar">
                <div class="sidebar-inner">
                    <div class="si-inner">
                
                        <ul class="main-menu" style="margin:0px;" >

                            <li class="sub-menu active toggled">
                                <a href=""><i class="md md-my-library-books"></i> Inventory</a>
                
                                <ul>
                                    <li><a class="active" href="form-elements.html">Weekly Inventory</a></li>
                                    <li><a href="form-components.html">End Of Month Inventory</a></li>
                                    <li><a href="form-examples.html">Inventory Adjust</a></li>
                                    
                                </ul>
                            </li>


                        </ul>
                    </div>
                </div>
            </aside>
            
        
        @yield('content')
           
        <!-- Older IE warning message -->
        <!--[if lt IE 9]>
            <div class="ie-warning">
                <h1 class="c-white">IE SUCKS!</h1>
                <p>You are using an outdated version of Internet Explorer, upgrade to any of the following web browser <br/>in order to access the maximum functionality of this website. </p>
                <ul class="iew-download">
                    <li>
                        <a href="http://www.google.com/chrome/">
                            <img src="img/browsers/chrome.png" alt="">
                            <div>Chrome</div>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.mozilla.org/en-US/firefox/new/">
                            <img src="img/browsers/firefox.png" alt="">
                            <div>Firefox</div>
                        </a>
                    </li>
                    <li>
                        <a href="http://www.opera.com">
                            <img src="img/browsers/opera.png" alt="">
                            <div>Opera</div>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.apple.com/safari/">
                            <img src="img/browsers/safari.png" alt="">
                            <div>Safari</div>
                        </a>
                    </li>
                    <li>
                        <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
                            <img src="img/browsers/ie.png" alt="">
                            <div>IE (New)</div>
                        </a>
                    </li>
                </ul>
                <p>Upgrade your browser for a Safer and Faster web experience. <br/>Thank you for your patience...</p>
            </div>   
        <![endif]-->
    
        <!-- Javascript Libraries -->
   

        <script src="{{ asset('theme/Template/js/jquery-2.1.1.min.js') }}"></script>
        <script src="{{ asset('theme/Template/js/bootstrap.min.js') }}"></script>
        
        <script src="{{ asset('theme/Template/vendors/nicescroll/jquery.nicescroll.min.js') }}"></script>
        <script src="{{ asset('theme/Template/vendors/auto-size/jquery.autosize.min.js') }}"></script>
        <script src="{{ asset('theme/Template/vendors/waves/waves.min.js') }}"></script>
        <script src="{{ asset('theme/Template/vendors/bootstrap-growl/bootstrap-growl.min.js') }}"></script>
        <script src="{{ asset('theme/Template/vendors/sweet-alert/sweet-alert.min.js') }}"></script>

        <script src="{{ asset('theme/Template/js/functions.js') }}"></script>

        @yield('js')
 
    
    </body>
</html>