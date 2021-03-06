<!DOCTYPE html>
    <!--[if IE 9 ]><html class="ie9"><![endif]-->
    <head>
    <style>
    .fc-today {
    background: #ffeb3b; /* #fcf8e3*/
}
</style>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Atomic Burger Admin</title>
        
        <!-- Vendor CSS -->
        <link href="/theme/Template/vendors/fullcalendar/fullcalendar.css" rel="stylesheet">
        <link href="/theme/Template/vendors/animate-css/animate.min.css" rel="stylesheet">
        <link href="/theme/Template/vendors/sweet-alert/sweet-alert.min.css" rel="stylesheet">
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
                            <li class="sub-menu">
                                 <a href=""><i class="md md-my-library-books"></i>Inventory</a>
                                  <ul>
                                    <li><a href="/inventory/adjust">Adjust Inventory</a></li>
                                    <li><a href="/inventory/reports">Inventory Reports</a></li>
                                </ul>
                                
                                   
                            </li>
                              <li >
                                <a href="/ordering"><i class="md md-shopping-cart"></i> Order Forms</a>
                            </li>
                               <li >
                                <a href="/sales"><i class="md  md-attach-money"></i> Sales</a>
                            </li>
                             <li class="sub-menu">
                                 <a href=""><i class="md md-work"></i>Tools</a>
                                  <ul>
                                    <li><a href="/tools/meatcalculator">Meat Calculator</a></li>
                                 
                                </ul>
                            </li>
                           
                           <li >
                                <a href="/employees"><i class="md md-account-circle"></i>Employee Files</a>
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
   

        <script src="/theme/Template/js/jquery-2.1.1.min.js"></script>
        <script src="/theme/Template/js/bootstrap.min.js"></script>
        
        <script src="/theme/Template/vendors/nicescroll/jquery.nicescroll.min.js"></script>
        <script src="/theme/Template/vendors/auto-size/jquery.autosize.min.js"></script>
        <script src="/theme/Template/vendors/waves/waves.min.js"></script>
        <script src="/theme/Template/vendors/bootstrap-growl/bootstrap-growl.min.js"></script>
        <script src="/theme/Template/vendors/sweet-alert/sweet-alert.min.js"></script>
        <script src="/theme/Template/vendors/fullcalendar/lib/moment.min.js"></script>
        <script src="/theme/Template/vendors/fullcalendar/fullcalendar.min.js"></script>

        <script src="/theme/Template/js/functions.js"></script>


        @yield('js')
 
    
    </body>
</html>