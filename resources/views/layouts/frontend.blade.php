<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('partials.frontend.head')
 
    
    <body >
    <div class="scale-container" >
            <!-- Page Preloder -->
   {{-- <div id="preloder">
        <div class="loader"></div>
    </div>   --}}
    <div class="container_loader" id="preloder">
        <div class="item-1"></div>
        <div class="item-2"></div>
        <div class="item-3"></div>
        <div class="item-4"></div>
        <div class="item-5"></div>
      </div>
    {{-- <div class="overlay" id="preloder">
        <div class="d-flex justify-content-center" style="vertical-align: middle;">  
          <div class="spinner-grow "  role="status" style="width: 3rem; height: 3rem; z-index: 20;color:#7fad39;vertical-align: middle;">
            <span class="sr-only">Loading...</span>
          </div>
        </div>
      </div> --}}
    <!-- Humberger Begin -->
    <div class="humberger__menu__overlay"></div>
    <div class="humberger__menu__wrapper">
        <div class="humberger__menu__logo">
            <a href="/"><img src="{{ asset('assets/frontend/img/logo.png') }}" alt=""></a>
        </div>
        {{-- <div class="humberger__menu__cart">
            <ul>
                <li><a href="#"><i class="fa fa-heart"></i> <span>1</span></a></li>
                <li><a href="#"><i class="fa fa-shopping-bag"></i> <span>3</span></a></li>
            </ul>
            <div class="header__cart__price">item: <span>$150.00</span></div>
        </div> --}}
       @include('partials.frontend.header-mobile')
        @include('partials.frontend.navbar-mobile')
        <div id="mobile-menu-wrap"></div>
        <div class="header__top__right__social">
            @foreach ($links as $link)
            <a href="{{ $link->link }}"><i class="{{ $link->icon->code }}"></i></a>

            @endforeach
        </div>
        <div class="humberger__menu__contact">
            <ul>
                <li><i class="fa fa-envelope"></i> {{ $email }}</li>
                
            </ul>
        </div>
    </div>
    @include('partials.frontend.header')
   @stack('hero-section')
    @stack('carousel')
  @yield('content')

 

<div class="customizer-btn cart-icon" style="border-radius: 50%;background:#7fad39;margin:10px">
    <a href="{{ route('cart') }}"><i class="fas fa-shopping-cart" style="font-size: 30px;color:#fff"></i> </a><!-- Cart icon -->
    <span class="cart-badge">0</span>    <!-- Notification badge -->
  </div>

{{-- </a> --}}

    @include('partials.frontend.footer')
    @include('partials.frontend.scripts')
</div>
        <input type="hidden" value="{{ auth()->id() ?? ''}}" id="auth">
   
    <!-- Humberger End -->
    </body>

    </html>
