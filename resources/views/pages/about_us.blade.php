@extends('layouts.frontend')
@push('name')
{{ __('frontend.about_us') }}
@endpush
@push('style')
<link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.3/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://unpkg.com/bs-brain@2.0.4/components/abouts/about-2/assets/css/about-2.css">
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
    <section class="py-3 py-md-5" style="direction: {{ app()->getLocale() == 'ar' ? 'rtl':'ltr' }};text-align:{{ app()->getLocale() == 'ar' ? 'right':'left' }}">
        <div class="container">
          <div class="row gy-3 gy-md-4 gy-lg-0 align-items-lg-center">
            <div class="col-12 col-lg-6">
              <img class="img-fluid rounded" loading="lazy" src="{{ $row->image_url }}" alt="About 2">
            </div>
            <div class="col-12 col-lg-6">
              <div class="row justify-content-xl-center">
                <div class="col-12 col-xl-10">
                  <h2 class="mb-3">{{ __('frontend.Why Choose Us?') }}</h2>
                  <p class="lead fs-4 mb-3 mb-xl-5">
                    @if (app()->getLocale() ==  'ar')
                       {!!  $row->descrption_ar  !!}
                    @else
                      {!! $row->descrption_en !!}
                    @endif

                  </p>
               
                  <a href="{{ route('contact_us') }}" type="button" class="btn bsb-btn-xl btn btn-sucess rounded-pill" style="background: #7fad39;color:#fff">Connect Now</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
@endsection
