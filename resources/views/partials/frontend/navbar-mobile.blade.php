<nav class="humberger__menu__nav mobile-menu">
    <ul class="active_li">
        <li ><a  href="{{ route('home') }}" id="active_li">{{ __('frontend.Home') }}</a></li>
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
        {{-- <li><a href="{{ route('cart') }}" id="active_li">{{ __('frontend.cart') }}</a></li> --}}

        {{-- <li><a href="#">{{ __('frontend.sub_departement') }}</a>
            <ul class="header__menu__dropdown">
                @foreach ($sub_departements as $sub_departement)
                <li><a  href="{{ route('shop.search',['category'=>$sub_departement->name]) }}" id="search-link">{{ $sub_departement->name }}</a></li>
                @endforeach
            
            </ul>
        </li> --}}
    </ul>
</nav>