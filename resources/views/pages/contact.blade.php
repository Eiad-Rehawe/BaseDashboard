@extends('layouts.frontend')
@push('name')
{{ __('frontend.contact_us') }}
@endpush


@section('content')
<section class="hero hero-normal">
  <div class="container">
    <div class="row">
      @include('partials.frontend.hero-categories')
      <div class="col-lg-9">
        @include('partials.frontend.search')
      </div>
    </div>
  </div>
</section>


@include('partials.frontend.pages-herosection')
<section class="contact spad">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                <div class="contact__widget">
                    <span class="icon_phone"></span>
                    <h4>{{ __('frontend.Phone') }}</h4>
                    <p>{{ $phone }}</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                <div class="contact__widget">
                    <span class="icon_pin_alt"></span>
                    <h4>{{ __('frontend.Address') }}</h4>
                    <p>{{ app()->getLocale() == 'ar' ? $address_ar : $address_en }}</p>
                </div>
            </div>
           
            <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                <div class="contact__widget">
                    <span class="icon_mail_alt"></span>
                    <h4>{{ __('frontend.Email') }}</h4>
                    <p>{{ $email }}</p>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="contact-form spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="contact__form__title">
                    <h2>{{ __('frontend.Leave Message') }}</h2>
                </div>
            </div>
        </div>
        <form action="{{ route('user.contact') }}" method="post" class="submit-form" style="direction: {{ app()->getLocale() == 'ar' ? 'rtl':'ltr' }};text-align:{{ app()->getLocale() == 'ar' ? 'right':'left' }};" >
            @method('post')
            @csrf
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <input type="text" style="border :1px solid #7fad39;border-radius:10px;text-align:{{ app()->getLocale() == 'ar' ? 'right':'left' }}" placeholder="{{ __('frontend.Your name') }}" name="name" value="{{ old('name') }}">
                    <div id="input-name" style="color: red"></div>

                </div>
                <div class="col-lg-6 col-md-6">
                    <input type="text"  style="border :1px solid #7fad39;border-radius:10px;text-align:{{ app()->getLocale() == 'ar' ? 'right':'left' }}" placeholder="{{ __('frontend.Your email or phone') }}" name="email_or_phone" value="{{ old('email_or_phone') }}">
                    <div id="input-email_or_phone" style="color: red"></div>

                </div>
                <div class="col-lg-12 text-center">
                    <textarea style="border :1px solid #7fad39;border-radius:10px;text-align:{{ app()->getLocale() == 'ar' ? 'right':'left' }}" placeholder="{{ __('frontend.Your message') }}" name="message"></textarea>
                    <div id="input-message" style="color: red"></div>

                    <button type="submit" class="site-btn set_order" style="padding: 10px" >{{ __('frontend.send message') }}</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection