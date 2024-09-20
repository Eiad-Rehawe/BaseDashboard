@extends('layouts.frontend')
@push('section')
<div class="col-lg-9">
  @include('partials.frontend.search')
   @if(!empty($poster))
   <div class="hero__item set-bg" data-setbg="{{$poster->product != null ? $poster->product->files()->first()->file_url : $poster->category->files()->first()->category_url }}">
    <div class="hero__text">
        <span>{{ $poster->category->name ?? '' }}</span>
        <h2>{{ $poster->product->name ?? '' }} </h2>
      
        @isset($poster->product)
        <a href="{{ route('front.product',$poster->product->id) }}" class="primary-btn">{{ __('frontend.SHOP NOW') }}</a>
        @endisset
    </div>
</div>
   @endif
</div>
@endpush
@push('hero-section')
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
@endpush
@push('carousel')
@include('partials.frontend.categories-section')
@endpush
@section('content')
@if(!empty($offers_category))
@include('partials.frontend.categories-offer')
@endif
@include('partials.frontend.featured-products')

@include('partials.frontend.latest-products')
{{-- @push('carousel') --}}
{{-- @include('partials.frontend.categories-section') --}}
{{-- @endpush --}}
@endsection
@push('scripts')
<script>

 $(document).ready(function(e){
    
    for(let i =0; i<$('#count_products').attr('value'); i++){
        
        $(`d_${i}`).toggle();
    }
 })

</script>


@endpush