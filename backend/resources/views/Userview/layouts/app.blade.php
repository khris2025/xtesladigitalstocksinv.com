<!doctype html>
<html lang="en">
   <head>
      <meta charset="utf-8" />
      <title>Dashboard | User</title>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <!-- App favicon -->
      <link rel="shortcut icon" href="favicon.png">
      <!-- plugin css -->
      <link href="{{ asset('assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css') }}" rel="stylesheet" type="text/css" />
      <!-- preloader css -->
      <link rel="stylesheet" href="{{ asset('assets/css/preloader.min.css') }}" type="text/css" />
      <!-- Bootstrap Css -->
      <link href="{{ asset('assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
      <!-- Icons Css -->
      <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
      <!-- App Css-->
      <link href="{{ asset('assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" integrity="sha512-c42qTSw/wPZ3/5LBzD+Bw5f7bSF2oxou6wEb+I/lqeaKV5FDIfMvvRp772y4jcJLKuGUOpbJMdg/BTl50fJYAw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.9/sweetalert2.min.css" integrity="sha512-cyIcYOviYhF0bHIhzXWJQ/7xnaBuIIOecYoPZBgJHQKFPo+TOBA+BY1EnTpmM8yKDU4ZdI3UGccNGCEUdfbBqw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
      <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.9/sweetalert2.all.min.js" integrity="sha512-IZ95TbsPTDl3eT5GwqTJH/14xZ2feLEGJRbII6bRKtE/HC6x3N4cHye7yyikadgAsuiddCY2+6gMntpVHL1gHw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
      <script src="https://unpkg.com/feather-icons"></script>
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   </head>
   <header id="page-topbar">
      <div class="navbar-header">
         <div class="d-flex">
            {{-- <button type="button" class="btn btn-sm px-3 font-size-16 header-item" id="vertical-menu-btn">
            <i class="fa fa-fw fa-bars"></i>
            </button> --}}
            <!-- App Search-->
            <form class="app-search d-none d-lg-block">
               <div class="position-relative">
                  <input type="text" class="form-control" placeholder="Search...">
                  <button class="btn btn-primary" type="button"><i class="bx bx-search-alt align-middle"></i></button>
               </div>
            </form>
         </div>
         <div class="d-flex">
            {{-- <div class="mt-3  d-sm-inline-block">
               <div id="google_translate_element"></div>
            </div> --}}
            {{-- <div class="dropdown d-inline-block  ms-2">
               <button type="button" class="btn header-item" id="mode-setting-btn">
               <i data-feather="moon" class="icon-lg layout-mode-dark"></i>
               <i data-feather="sun" class="icon-lg layout-mode-light"></i>
               </button>
            </div> --}}
            <div class="dropdown d-inline-block">
               {{-- <button type="button" class="btn header-item bg-soft-light border-start border-end" id="page-header-user-dropdown"
                  data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
               <img class="rounded-circle header-profile-user" src="{{ asset('assets/images/users/avatar-1.png') }}"
                  alt="Header Avatar">
               <span class="d-none d-xl-inline-block ms-1 fw-medium">{{ Auth::user()->fullname }}</span>
               <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
               </button>
               <div class="dropdown-menu dropdown-menu-end">
                  <!-- item-->
                  <a class="dropdown-item" href="{{ route('profile') }}"><i class="mdi mdi-face-profile font-size-16 align-middle me-1"></i> Profile</a>
                  <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                  Logout
                  </a>
               </div> --}}
               <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                  <i class="fas fa-power-off"></i>
               </a>
            </div>
         </div>
      </div>
      <div class="vertical-menu">
         <div data-simplebar class="h-100">
            <!--- Sidemenu -->
            <div id="sidebar-menu">
               <!-- Left Menu Start -->
               <ul class="metismenu list-unstyled" id="side-menu">
                  <li class="menu-title" data-key="t-menu">Menu</li>
                  <li>
                     <a href="{{ route('dashboard') }}">
                     <i data-feather="home"></i>
                     <span data-key="t-dashboard">Dashboard</span>
                     </a>
                  </li>
                  <li>
                     <a href="{{ route('profile') }}">
                     <i data-feather="user"></i>
                     <span data-key="t-dashboard">My Profile</span>
                     </a>
                  </li>
                  <li>
                     <a href="{{ route('member') }}">
                     <i data-feather="user"></i>
                     <span data-key="t-dashboard">Membership</span>
                     </a>
                  </li>
                  <li>
                     <a href="{{ route('activities') }}">
                     <i data-feather="repeat"></i>
                     <span data-key="t-dashboard">Activities</span>
                     </a>
                  </li>
                  <li>
                     <a href="{{ route('Investments') }}">
                     <i class="fa fa-tags" style="font-size: 15px"></i>
                     <span data-key="t-dashboard">Plans</span>
                     </a>
                  </li>
                  <li>
                     <a href="{{ route('stocks') }}">
                     <i class="fa fa-briefcase" style="font-size: 15px"></i>
                     <span data-key="t-dashboard">Stocks</span>
                     </a>
                  </li>
                  
                  

                  {{-- <li>
                     <a href="{{ route('stocks') }}">
                     <i class="fa fa-briefcase" style="font-size: 15px"></i>
                     <span data-key="t-dashboard">Stocks</span>
                     </a>
                  </li> --}}
                  <li>
                     <a href="{{ route('tesla') }}">
                     <i class="fa fa-car-side" style="font-size: 15px"></i>
                     <span data-key="t-dashboard">Cars</span>
                     </a>
                  </li>

                  <li>
                     <a href="{{ route('kyc_upload') }}">
                     <i data-feather="user"></i>
                     <span data-key="t-dashboard">Account Upgrade</span>
                     </a>
                  </li>
                  <li>
                     <a href="{{ route('portfolio') }}">
                     <i class="fa fa-rocket" style="font-size: 15px"></i>
                     <span data-key="t-dashboard">Portfolio</span>
                     </a>
                  </li>
                  <li class="menu-title mt-2" data-key="t-components">Finances</li>
                  <li>
                     <a href="{{ route('deposit') }}">
                     <i data-feather="credit-card"></i>
                     <span data-key="t-dashboard">Deposit Funds</span>
                     </a>
                  </li>
                  <li>
                     <a href="{{ route('withdrawal') }}">
                     <i data-feather="briefcase"></i>
                     <span data-key="t-dashboard">Withdraw Funds</span>
                     </a>
                  </li>
                  {{-- <li>
                     <a href="{{ route('copy_trade') }}">
                     <i class="fa fa-users" style="font-size: 15px;"></i>
                     <span data-key="t-dashboard">Copy Experts</span>
                     </a>
                  </li> --}}
                  <li>
                     <a href="{{ route('purchase_signals') }}">
                     <i class="fa fa-users" style="font-size: 15px;"></i>
                     <span data-key="t-dashboard">Purchase Signals</span>
                     </a>
                  </li>
                  <li class="menu-title mt-2" data-key="t-components">Extras</li>
                  <li>
                     <a href="{{ route('referral') }}">
                     <i data-feather="users"></i>
                     <span data-key="t-dashboard">Manage Referrals</span>
                     </a>
                  </li>
                  <li>
                     <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                     <i data-feather="log-out"></i>
                     <span data-key="t-logout">Logout</span>
                     </a>
                     <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                     </form>
                  </li>
               </ul>
            </div>
         </div>
      </div>
   </header>
   {{-- Logout Script --}}
   <script>
      document.querySelector('a[href="{{ route('logout') }}"]').addEventListener('click', function(event) {
          event.preventDefault();
          document.getElementById('logout-form').submit();
      });
   </script>
   <nav class="mobile-bottom-nav d-md-none">
      <a href="{{ route('dashboard') }}"
         class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
         <i class="fa fa-home"></i>
         <span>Home</span>
      </a>
      <a href="{{ route('Investments') }}"
       class="{{ request()->routeIs('Investments') ? 'active' : '' }}">
         <i class="fa fa-tags"></i>
         <span>Plans</span>
      </a>
      <a href="{{ route('purchase_signals') }}"
       class="{{ request()->routeIs('purchase_signals') ? 'active' : '' }}">
         <i class="fa fa-signal"></i>
         <span>Signal</span>
      </a>
      <a href="{{ route('stocks') }}"
       class="{{ request()->routeIs('stocks') ? 'active' : '' }}">
         <i class="fa fa-briefcase"></i>
         <span>Stocks</span>
      </a>
      <a href="{{ route('portfolio') }}"
         class="{{ request()->routeIs('portfolio') ? 'active' : '' }}">
         <i class="fa fa-briefcase"></i>
         <span>Portfolio</span>
      </a>
      {{-- <a href="{{ route('member') }}"
         class="{{ request()->routeIs('member') ? 'active' : '' }}">
         <i data-feather="user"></i>
         <span>Membership</span>
      </a> --}}
      <a href="{{ route('profile') }}"
         class="{{ request()->routeIs('profile') ? 'active' : '' }}">
         <i class="fa fa-user"></i>
         <span>Profile</span>
      </a>
   </nav>
   <style>
      .mobile-bottom-nav {
      position: fixed;
      bottom: 0;
      left: 0;
      right: 0;
      z-index: 1050;
      background: #fff;
      border-top: 1px solid #e5e5e5;
      display: flex;
      justify-content: space-around;
      align-items: center;
      height: 65px;
      box-shadow: 0 -2px 10px rgba(0,0,0,.08);
      }
      .mobile-bottom-nav a {
      display: flex;
      flex-direction: column;
      align-items: center;
      color: #6c757d;
      text-decoration: none;
      font-size: 11px;
      }
      .mobile-bottom-nav a i {
      font-size: 20px;
      margin-bottom: 4px;
      }
      .mobile-bottom-nav a.active {
      color: #0d6efd;
      }
      @media (min-width: 768px) {
      .mobile-bottom-nav {
      display: none;
      }
      }
      @media (max-width: 767px) {
      .page-content {
         padding-bottom: 80px;
      }
   }
   </style>
   <body data-sidebar-size="lg" data-layout-mode="light" data-topbar="light" data-sidebar="light">
      @yield('content')
      <!-- FOOTER -->
      <footer class="footer">
         <div class="container-fluid">
         <div class="row">
            <div class="col-sm-6">
               {{-- <script>document.write(new Date().getFullYear())</script> © X TESLA DIGITAL STOCKS INV.  --}}
               © X TESLA DIGITAL STOCKS INV.  - 2026
               <div class="col-sm-6">
                  <div class="text-sm-end d-none d-sm-block">
                  </div>
               </div>
            </div>
         </div>
      </footer>
      <script type="text/javascript">
         function googleTranslateElementInit() {
           new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
         }
      </script>
      <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
      <!-- Right bar overlay-->
      <div class="rightbar-overlay"></div>
      <!-- JAVASCRIPT -->
      <script>
         feather.replace()
      </script>
      <script src=" {{asset('assets/libs/jquery/jquery.min.js')}} "></script>
      <script src=" {{asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js')}} "></script>
      <script src="{{asset('assets/libs/metismenu/metisMenu.min.js')}} "></script>
      <script src="{{asset('assets/libs/simplebar/simplebar.min.js')}} "></script>
      <script src="{{asset('assets/libs/node-waves/waves.min.js')}} "></script>
      <!-- Plugins js-->
      <script src="{{asset('assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js')}} "></script>
      <script src="{{asset('assets/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-world-mill-en.js')}} "></script>
      <!-- dashboard init -->
      <script src="{{asset('assets/js/pages/dashboard.init.js')}} "></script>
      <script src="{{asset('assets/js/app.js')}} "></script>  
      

         <!-- Smartsupp Live Chat script -->
   <script type="text/javascript">
      var _smartsupp = _smartsupp || {};
      _smartsupp.key = '1d0c7ecad49a4cba5a89dd5b165ff08071fbea62';
      window.smartsupp || (function (d) {
         var s, c, o = smartsupp = function () { o._.push(arguments) }; o._ = [];
         s = d.getElementsByTagName('script')[0]; c = d.createElement('script');
         c.type = 'text/javascript'; c.charset = 'utf-8'; c.async = true;
         c.src = 'https://www.smartsuppchat.com/loader.js?'; s.parentNode.insertBefore(c, s);
      })(document);
   </script>
   <noscript>Powered by <a href="https://www.smartsupp.com" target="_blank">Smartsupp</a></noscript>
   





   </body>
</html>