@extends('layouts.frontend')
@push('name')
{{ app()->getLocale() == 'ar' ? $row->name_ar :$row->name_en }}
@endpush
@push('category')
{{ app()->getLocale() == 'ar' ? $row->category->name_ar : $row->category->name_en}}
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
<!-- Breadcrumb Section End -->

<!-- Product Details Section Begin -->
<section class="product-details spad">
    <div class="container">
        <div class="row">
       
            <div class="col-lg-6 col-md-6">
                <div class="product__details__pic">
                    <div class="product__details__pic__item">
                        <img class="product__details__pic__item--large"
                            src="{{ $row->files->first()->file_url }}" alt="">
                    </div>
                    <div class="product__details__pic__slider owl-carousel">
                        @if(count($row->files) >1)
                        @foreach ($row->files as $file)
                        <img data-imgbigurl="{{ $file->file_url }}" src="{{ $file->file_url }}"
                            alt="">
                        @endforeach
                        @endif
                       
                    </div>
                </div>
            </div>
     
            <div class="col-lg-6 col-md-6">
                <div class="product__details__text">
                    <h3>{{ app()->getLocale() == 'ar' ? $row->name_ar :$row->name_en }}</h3><span>({{count($row->ratings)}}){{ __('frontend.reviews')
                        }}</span>
                       @if(count($row->ratings) > 0)
                       <?php $rate=''; ?>
                       @for ($j=0;$j<count($row->ratings); $j++)
                           <?php $rate=$row->ratings[$j]->avg('rating'); ?>

                           @endfor

               <p>{{ __('frontend.avg_rate') }} {{ $rate != 0 ? round( $rate,1) : 0}}</p>
                       @endif
                    <input type="hidden" name="" id="productId" class="{{ $row->id }}">
                   
                    <div class="row"
                        style="display:flex;justify-content:{{ app()->getLocale() == 'ar' ? 'right':'left'}}">
                        <div class="col-lg-5">
                            <div class="rating" data-rating="0">
                                
                                @for ($i = 1; $i <= 5; $i++) 
                                @if ($i <=5 ) <i class="fas fa-star "
                                data-value="{{ $i }}"></i> <!-- Filled star -->
                                @else
                                <i class="fa fa-star text-warning" data-value="{{ $i }}"></i>
                                @endif
                                 @endfor  

                                 
                            </div>

                        </div>
                        <div class="col-lg-2 product__details__price">{{ $row->selling_price }}</div>
                    </div>
                    <p>{!! $row->descrption !!}</p>
                    <div class="product__details__quantity">
                        <div class="quantity">
                            <div class="pro-qty">
                                <input type="text" value="1" id="pro_{{ $row->id }}">
                            </div>
                        </div>
                    </div>

                
                    <a href="{{ route('getProductWhenClickCart',$row->id) }}" class="primary-btn" id="btn-cart-button-new">
                        {{ __('frontend.ADD TO CARD') }}
                        
                    </a>
              


                            <a @auth href="{{ route('favourite',['id'=>$row->id]) }}" data-id="{{ $row->id }}" @else href="{{ route('getProductWhenClickCart',$row->id) }}" @endauth  class="{{$row->id}} heart-icon"  id="btn-fav-button"><span
                                class="icon_heart_alt"></span></a>
                  
                   {{-- @if($row->weight != null) --}}
                   
                    <ul style="direction: {{ app()->getLocale() == 'ar' ? 'rtl' :'ltr' }};text-align:{{ app()->getLocale() == 'ar' ? 'right' :'left' }}">

                        <li><b>{{ __('frontend.Weight') }}</b> <span>{{ $row->wight }} {{ app()->getLocale() == 'ar' ? $row->weight_measurement->name_ar : $row->weight_measurement->name_en
                                }}</span></li>
                            <li><b>{{ __('frontend.Availability') }}</b> <span> {{ $row->quantity > 0 ? __('frontend.In Stock') : __('frontend.out_of_stock') }} </span></li>
                   
                    </ul>
                   {{-- @endif --}}
                    <ul>
                        <form action="{{ route('comment') }}" method="post" class="submit-form">
                            @csrf
                            @method('post')
                            <input type="hidden" name="product_id" id="" value="{{ $row->id }}">
                            <label for="">{{ __('frontend.please_add_comment') }}</label>
                            <textarea name="comment" id="" cols="30" rows="10" class="form-control" style="border :1px solid #7fad39;border-radius:10px;text-align:{{ app()->getLocale() == 'ar' ? 'right':'left' }}"></textarea>
                            <br>
                            <button type="submit" class="primary-btn">{{ __('frontend.send') }}</button>
                        </form>
                    </ul>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="product__details__tab">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab"
                                aria-selected="true">{{ __('frontend.descrption') }}</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab" aria-selected="false">{{
                                __('frontend.comments') }} <span></span></a>
                        </li>

                        
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tabs-4" role="tab" aria-selected="false">{{
                                __('frontend.Send a complaint') }} <span></span></a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tabs-1" role="tabpanel"
                            style="text-align:{{ app()->getLocale() == 'ar' ? 'right':'left' }}">
                            <div class="product__details__tab__desc">
                                <h6>{{ __('frontend.descrption') }}</h6>
                                <p>{!! app()->getLocale() == 'ar' ? $row->descrption_ar : $row->descrption_en!!}</p>

                            </div>
                        </div>

                        <div class="tab-pane" id="tabs-3" role="tabpanel"
                            style="direction:{{ app()->getLocale() == 'ar' ? 'rtl':'ltr' }};text-align:{{ app()->getLocale() == 'ar' ? 'right':'left' }}">
                            <div class="product__details__tab__desc">
                                <h6>{{ __('frontend.comments') }}</h6>
                                @forelse ($row->comments as $comment)

                                <div
                                    style="direction:{{ app()->getLocale() == 'ar' ? 'ltr':'rtl' }};text-align:{{ app()->getLocale() == 'ar' ? 'right':'left' }}">
                                    {{ $comment->comment }}<img src="{{ $comment->user->profile_url }}" alt="wwd"
                                        style="width:35px;height:35px;border-radius: 50%;margin:3px;"></div><br><br>

                                @empty
                                <div style="text-align: center">{{ __('frontend.not_found') }}</div>
                                @endforelse

                            </div>
                        </div>

                        <div class="tab-pane " id="tabs-4" role="tabpanel"
                        style="text-align:{{ app()->getLocale() == 'ar' ? 'right':'left' }}">
                        <div class="product__details__tab__desc">
                            <h6>{{ __('frontend.Send a complaint') }}</h6>
                            <form action="{{ route('user.complaints') }}" style="direction: {{ app()->getLocale() == 'ar' ? 'rtl':'ltr' }};text-align:{{ app()->getLocale() == 'ar' ? 'right':'left' }}" method="post"
                                enctype="multipart/form-data" class="submit-form-complaiments validation-wizard wizard-circle mt-5">
                                @csrf
                                @method('post')
                                <input type="hidden" name="product_id" value="{{ $row->id }}">
                              
                                <div class="row">
                                    <label for="complaint_text">{{ __('table.complaint_text') }} </label>
                                    <textarea style="border :1px solid #7fad39;border-radius:10px;" cols="80" id="editor1" name="complaint_text" rows="3" data-sample="2" class="form-control" data-sample-short>{!! $row->complaint_text ?? old('complaint_text') !!}</textarea>
                                    <div id="input-complaint_text" style="color: red"></div>
                            
                                  </div>
                                  
                                  <div class="mb-3 col-md-12">
                                    <button class="
                                      btn
                                      rounded-pill
                                      px-4
                                      btn btn-success
                                      font-weight-medium
                                      waves-effect waves-light
                                    " type="submit" style="float:center;background:#7fad39;margin-top:20px">
                                      <i class="ti ti-send fs-5"></i>
                                      {{ __('table.Submit') }}
                                    </button>
                                  
                                  </div>
                                  
                            </form>

                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Product Details Section End -->

<!-- Related Product Section Begin -->
@include('partials.frontend.related-products')
@endsection