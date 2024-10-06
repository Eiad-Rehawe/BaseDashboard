


<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    @include("partials.head")
    <title>{{config('app.APP_NAME'.'laravel')}}</title>
    <!-- Owl Carousel  -->
    <link
      rel="stylesheet"
      href="{{asset('assets/dashboard/libs/owl.carousel/dist/assets/owl.carousel.min.css')}}"
    />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/js/app.js'])
    @stack('style')
  </head>

  <body >
    <!-- Preloader -->
    <div class="preloader">
      <img
        src="{{ asset('assets/dashboard/images/logos/favicon.png') }}"
        alt="loader"
        class="lds-ripple img-fluid"
      />
    </div>
    <div id="main-wrapper">
      <!-- Sidebar Start -->
      <aside class="left-sidebar with-vertical">
        <div>@include("partials.sidebar")</div>
      </aside>
      <!--  Sidebar End -->
      <div class="page-wrapper">
        <!--  Header Start -->
        <header class="topbar">
          <div class="with-vertical">@include("partials.header")</div>
          <div class="app-header with-horizontal">
            @include("partials.horizontal-header")
          </div>
        </header>
        <!--  Header End -->

        <aside class="left-sidebar with-horizontal">
          @include("partials.horizontal-sidebar")
        </aside>

        <div class="body-wrapper">
          <div class="container-fluid" style="padding: 0%">
            <!--  Owl carousel -->
            
           @yield('content')
          </div>
        </div>
      
      </div>

      @include("partials.header-components.dd-searchbar")
      @include("partials.header-components.dd-shopping-cart")
      @include('backend.includes.modal')
    </div>
    <div class="dark-transparent sidebartoggler"></div>
    @include("partials.scripts")
    
    @stack('scripts')
    
  </body>
</html>
