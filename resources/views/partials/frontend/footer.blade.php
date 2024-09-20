<footer class="footer spad">
    <div class="container">
        <div class="row" style="direction:{{ app()->getLocale() == 'ar' ? 'rtl':'ltr' }}">
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="footer__about">
                    <div class="footer__about__logo">
                        <a href="./index.html"><img src="{{asset('assets/frontend/img/logo.png')}}" alt=""></a>
                    </div>
                    <ul>
                        <li>{{ __('frontend.Address') }}: {{ app()->getLocale() == 'en' ? $address_en :$address_ar }}</li>
                        <li>{{ __('frontend.Phone') }}: {{ $phone }}</li>
                        <li>{{ __('frontend.Email') }}: {{ $email }}</li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="footer__widget">
                    <h6>{{ __('frontend.Useful Links') }}</h6>
                    <ul style="float:{{ app()->getLocale() == 'ar' ? 'right':'left' }}">
                        
                        <li ><a href="{{ route('home') }}" >{{ __('frontend.Home') }}</a></li>
                        <li><a href="{{ route('shop') }}" >{{ __('frontend.shop') }}</a></li>
                        <li><a href="{{ route('compare') }}" >{{ __('frontend.compare') }}</a></li>
                        <li><a href="{{ route('cart') }}" >{{ __('frontend.Shoping Cart') }}</a></li>
                        <li><a href="{{ route('fav') }}" >{{ __('frontend.fav') }}</a></li>
                        <li><a href="{{ route('checkout') }}" >{{ __('frontend.checkout') }}</a></li>
                        <li><a href="{{ route('contact_us') }}" >{{ __('frontend.contact_us') }}</a></li>
                        <li><a href="{{ route('complaiment') }}">{{ __('frontend.Send a complaint') }}</a></li>
                        <li><a href="{{ route('about_us') }}" >{{ __('frontend.about_us') }}</a></li>

                    </ul>
                  
                </div>
            </div>
           
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="footer__copyright">
                    <div class="footer__copyright__text" style="text-align: center"><p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> {{ __('frontend.All rights reserved') }}   {{ __('frontend.by') }} {{ __('frontend.Herkel Tech') }}</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p></div>
                </div>
            </div>
        </div>
    </div>
</footer>