<section class="breadcrumb-section set-bg" data-setbg="{{ asset('assets/frontend/img/breadcrumb.jpg') }}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>@stack('name')</h2>
                    <div class="breadcrumb__option" style="direction: {{ app()->getLocale() == 'ar' ?'rtl':'ltr' }}">
                        <a href="{{ route('home') }}">{{ __('frontend.Home') }}</a>
                        <a href="" style="margin-top: 5px">@stack('name')</a>
                        <span>@stack('category')</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>