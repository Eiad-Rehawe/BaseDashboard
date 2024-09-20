<div class="humberger__menu__widget">
    <div class="header__top__right__language">
        <img src="{{flag()}}" alt="" height="14" width="27">
        <div>{{ lang() }}</div>
        <span class="arrow_carrot-down"></span>
        <ul>
            <li style="text-align: center"><a href="{{ LaravelLocalization::getLocalizedURL('ar', null, [], true) }}">Arabic</a></li>
            <li style="text-align: center"><a href="{{ LaravelLocalization::getLocalizedURL('en', null, [], true) }}">English</a></li>
        </ul>
    </div>
    <div class="header__top__right__auth">
        @auth
                    <div class="header__top__right__language">
                        
                        <div>{{ auth()->user()->name }}</div>
                        <span class="arrow_carrot-down"></span>
                        <ul>
                           <li>
                            <form method="POST" action="{{ route('admin.logout') }}">
                                @csrf
                          
                                <a href="{{route('admin.logout')}}" class="btn btn-success" style="background-color: #7fad39" onclick="event.preventDefault();
                          this.closest('form').submit();">{{ __('frontend.Log Out') }}</a>
                              </form>
                           </li>
                        </ul>
                    </div>
                        
                        @else
                        <a href="{{ route('login') }}"><i class="fa fa-user"></i> {{ __('frontend.Log in') }}</a>
                    @endauth
    </div>
</div>