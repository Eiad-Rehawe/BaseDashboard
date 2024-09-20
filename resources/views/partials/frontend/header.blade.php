<header class="header" >
    <div class="header__top">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4">
                    <div class="header__top__left" style="float:{{ app()->getLocale() == 'ar' ? 'left':'' }}">
                        <ul>
                            <li><i class="fa fa-envelope"></i>{{ $email }}</li>
                          
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4">
                <div class="hero__search__phone">
                    <div class="hero__search__phone__icon">
                        <i class="fa fa-phone"></i>
                    </div>
                    <div class="hero__search__phone__text" style="margin-top:13px ">
                        <h5>{{ $phone }}</h5>
                       
                    </div>
                </div>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="header__top__right">
                        <div class="header__top__right__social">
                            @foreach ($links as $link)
                            <a href="{{ $link->link }}"><i class="{{ $link->icon->code }}"></i></a>

                            @endforeach
                           
                        </div>
                        <div style="    position: relative;
                        display: inline-block;
                        margin-right: 40px;
                        cursor: pointer;">
                          

                          
                            <div class="dropdown">
                                <button class=" dropdown-toggle" style="border: #fff" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <img src="{{flag()}}" alt="" height="14" width="27">
                        
                            
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="    min-width: 5rem;background:#7fad39;color:#fff">
                                <a class="dropdown-item" style="text-align: center;color:#fff" href="{{ LaravelLocalization::getLocalizedURL('ar', null, [], true) }}">{{ __('frontend.Arabic') }}</a>
                                <a class="dropdown-item" style="text-align: center;color:#fff"  href="{{ LaravelLocalization::getLocalizedURL('en', null, [], true) }}">{{ __('frontend.English') }}</a>
                                </div>
                            </div>
                        </div>
                        <div class="header__top__right__auth">
                            @auth
                            <div style="    position: relative;
                            display: inline-block;
                            margin-right: 40px;
                            cursor: pointer;">
                                
                                {{-- <div>{{ auth()->user()->first_name }}</div>
                                <span class="arrow_carrot-down"></span>
                                <ul style="background: #fff">
                                   <li>
                                    <form method="POST" action="{{ route('logout') }}" style="background: #f5f5f5">
                                        @csrf
                                  
                                        <a href="{{route('logout')}}" class="btn btn-success" style="background-color: #7fad39" onclick="event.preventDefault();
                                  this.closest('form').submit();">{{ __('frontend.Log Out') }}</a>
                                      </form>
                                   </li>
                                </ul> --}}
                                <div class="dropdown">
                                    <button class=" dropdown-toggle" style="border: #fff" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        {{ auth()->user()->first_name }}
                                
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="    min-width: 5rem;padding:0rem">
                                      <a class="dropdown-item" href="" style="padding: 0px">
                                        <form method="POST" action="{{ route('logout') }}" style="background: #f5f5f5">
                                            @csrf
                                      
                                            <a href="{{route('logout')}}" class="btn btn-success" style="background-color: #7fad39;color:#fff" onclick="event.preventDefault();
                                      this.closest('form').submit();">{{ __('frontend.Log Out') }}</a>
                                          </form>
                                      </a>
                                    </div>
                                  </div>
                            </div>
                                
                                @else
                                <a href="{{ route('login') }}"><i class="fa fa-user"></i> {{ __('frontend.Log in') }}</a>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row" style="direction:{{ app()->getLocale() == 'ar' ? 'rtl':'ltr' }}">
            <div class="col-lg-1">
                <div class="header__logo">
                    <a href="/"><img src="{{asset('assets/frontend/img/logo.png')}}" alt=""></a>
                </div>
            </div>
            <div class="col-lg-11">
                <nav class="header__menu" style="direction:{{ app()->getLocale() == 'ar' ? 'rtl':'ltr' }}">
                    <ul class="active_li" id="dropdown-menu">
                        <li><a href="{{ route('home') }}" id="active_li">{{ __('frontend.Home') }}</a></li>
                       
                        {{-- <div class="dropdown">
                          
                            <li>  <a onclick="myFunction()" class="dropbtn">   {{ __('frontend.shop') }}</a>
                            </li>
                            <div id="myDropdown" class="dropdown-content">
                                @foreach($categories as $category)
                                <div class="dropdown-submenu" style="background: #7fad39">
                                    <a href="{{ route('shop.search',['category'=>$category->id]) }}" class="a" style="color: #fff" id="search-link" onmouseover="showDiv({{ $category->id }})" onmouseout="hideDiv({{ $category->id }})" >{{ app()->getLocale() == 'ar' ? $category->name_ar : $category->name_en }}</a>
                                    @if($category->children->count() > 0)
                                    <div class="dropdown-content"  style="background: #7fad39;display: none;{{ app()->getLocale() == 'ar' ? 'margin-right:-30px':'margin-left:-30px' }}" id="dropdownContent_{{ $category->id }}" >
                                        @foreach($category->children as $subcategory)
                                        <a style="color: #fff" href="{{ route('shop.search', ['category' => $subcategory->id]) }}" id="search-link">{{ app()->getLocale() == 'ar' ? $subcategory->name_ar : $subcategory->name_en }}</a>
                                        @endforeach
                                    </div>
                                    @endif
                                </div>
                                @endforeach
                            </div>
                        </div> --}}
                        <li><a href="{{ route('shop') }}" id="active_li">{{ __('frontend.shop') }}</a></li>

                        <li><a href="{{ route('compare') }}" id="active_li">{{ __('frontend.compare') }}</a></li>
                        <li><a href="{{ route('cart') }}" id="active_li">{{ __('frontend.Shoping Cart') }}</a></li>
                        <li><a href="{{ route('fav') }}" id="active_li">{{ __('frontend.fav') }}</a></li>
                        <li><a href="{{ route('checkout') }}" id="active_li">{{ __('frontend.checkout') }}</a></li>
                        <li><a href="{{ route('contact_us') }}" id="active_li">{{ __('frontend.contact_us') }}</a></li>
                        <li><a href="{{ route('complaiment') }}" id="active_li">{{ __('frontend.Send a complaint') }}</a></li>
                        <li><a href="{{ route('about_us') }}" id="active_li">{{ __('frontend.about_us') }}</a></li>
                        @auth
                        <li><a href="{{ route('my_orders') }}" id="active_li">{{ __('frontend.my_orders') }}</a></li>
                        @endauth
                    </ul>
                </nav>
            </div>
         
        </div>
        <div class="humberger__open" style="{{ app()->getLocale() == 'ar' ? 'left:15px':'right:15px' }}">
            <i class="fa fa-bars"></i>
        </div>
    </div>
</header>