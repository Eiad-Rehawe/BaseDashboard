@extends('layouts.frontend')
@push('name')
{{ __('frontend.shop')  }}

@endpush
{{-- @push('category')
{{ __('frontend.shop') }}
@endpush --}}
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
<section class="product spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-5">
                <div class="sidebar">
                    <div class="sidebar__item">
                        <h4>{{ __('frontend.departments') }}</h4>
                        <ul  style="padding:10px;
">
                            {{-- @foreach ($categories as $cat)
                            <li><a href="{{ route('shop.search',['category'=> $cat->id ]) }}" id="search-link">{{
                                    app()->getLocale() == 'ar' ? $cat->name_ar:$cat->name_en  }}</a></li>
                            @endforeach --}}
                            @foreach ($categories as $cat)
                            <li ><a href="{{ route('shop.search',['category'=>$cat->id]) }}" id="search-link" style="font-weight: bold">{{ app()->getLocale() == 'ar' ? $cat->name_ar : $cat->name_en }}</a></li>
                            @if(count($cat->children) > 0)
                            <nav aria-label="breadcrumb d-flex">
                                <ol class="breadcrumb">
                                    @foreach ($cat->children as $child)
                                    <li style="    border-bottom: 1px solid #fff;width:100%"><a href="{{ route('shop.search',['category'=>$child->id]) }}" id="search-link">{{ app()->getLocale() == 'ar' ? $child->name_ar : $child->name_en }}</a>
                                     
                                    </li>
                                    @endforeach
                                
                                </ol>
                              </nav>
                              @endif
                            @endforeach
                        </ul>
                    </div>
                   
                    <div class="sidebar__item">
                        <h4>{{ __('frontend.Price') }}</h4>
                        <div class="price-range-wrap">
                            <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"
                                data-min="{{ $min }}" data-max="{{ $max}}">
                                <div class="ui-slider-range ui-corner-all ui-widget-header"></div>
                                <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                                <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                            </div>

                            <div class="range-slider">
                                <div class="price-input d-flex">
                                    <input type="text" id="minamount" name="minamount" value="{{ $min }}">
                                    <input type="text" id="maxamount" name="maxamount" value="{{ $max}}">
                                </div>
                            </div>
                            <div class="spinner-border text-success" id="spinner-border" role="status"
                                style="display:none">

                            </div>
                        </div>
                    </div>

                    
                </div>
            </div>

            <div class="col-lg-9 col-md-7">
                @if(count($sales) > 0)
                <div class="product__discount">
                    <div class="section-title product__discount__title"
                        style="text-align:{{ app()->getLocale() == 'ar' ? 'right':'left' }}">
                        <h2>{{ __('frontend.Sale Off') }}</h2>
                    </div>
                    <div class="row">
                        <div class="product__discount__slider owl-carousel">
                            @foreach ($sales as $sale)
                            <div class="col-lg-4">
                                <div class="product__discount__item">
                                    
                                    <div class="product__discount__item__pic set-bg" id="{{ $sale->id }}"
                                        data-setbg="{{ $sale->files()->first() != null ? $sale->files()->first()->file_url :' '}}">
                                        <?php $result =(int)($sale->selling_price -$sale->new_selling_price)  / ($sale->selling_price ) * 100?>
                                       @if($result !=0)
                                        <div class="product__discount__percent">
                                            {{round($result, 2)}}%
                                        </div>
                                       
                                        @endif
                                        <ul class="product__item__pic__hover item__pic" id="{{ $sale->id }}" style="direction: {{ app()->getLocale() == 'ar' ? 'rtl':'ltr' }}">
                                            <li><a @auth href="{{ route('favourite',['id'=>$sale->id]) }}" data-id="{{ $sale->id }}"     @else  href="{{ route('getProductWhenClickCart',$sale->id) }}"  class="{{$sale->id}}"  @endauth   id="heart-btn-new"><i class="fa fa-heart"></i></a></li>

                                            <li><a id="view" href="{{ route('front.product',$sale->id) }}"><i
                                                        class="fa fa-eye"></i></a></li>
                                                        <li><a href="{{ route('getProductWhenClickCart',$sale->id) }}" id="add-cart-new">
                                                            <i class="fa fa-shopping-cart"></i>
                                                        </a></li>

                                            <li id="destroy" class="destroy_{{ $sale->id }}"
                                                style="display:none"><a href=""
                                                    class="destroy" id="{{ $sale->id }}"><i class="fa fa-trash"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="product__discount__item__text">
                                        <span>{{app()->getLocale() == 'ar' ?  $sale->name_ar : $sale->name_en}}</span>
                                        <div class="product__item__price">{{ $sale->new_selling_price }} <span>{{
                                                $sale->selling_price }}</span></div>
                                    </div>
                                    <div class="product__discount__item__text rating_" data-rating="0" style="padding-top: 10px">
                                             
                                        <?php $rate=''; ?>
                                        @for ($j=0;$j<count($sale->ratings); $j++)
                                            <?php $rate=$sale->ratings[$j]->avg('rating'); ?>
                                            @endfor
                                        @for ($i = 1; $i <= 5; $i++)
                                       
                                           @if ($i <= $rate )
                                               <i class="fas fa-star text-warning" data-value="{{ $i }}"></i> <!-- Filled star -->
                                               @else
                                               <i class="far fa-star" data-value="{{ $i }}"></i>
                                               @endif
                                            
                                              
                                              
                                               @endfor
                                       
                                       
                                     
        
                                </div>
                                </div>
                            </div>
                            @endforeach


                        </div>
                    </div>
                </div>
                @endif
                <div class="filter__item">
                    <div class="row">
                        <div class="col-lg-5 col-md-5 col-sm-5 col-5">
                            <div class="filter__sort">
                                <span>{{ __('frontend.Sort By weight') }}</span>
                                <select>
                                  
                                    {{-- @foreach ($wights as $product)
                                    
                                    <option value="{{ $product->wight }}">{{ $product->wight }} {{
                                        app()->getLocale() == 'ar' ? $product->weight_measurement->name_ar :$product->weight_measurement->name_en }}</option>
                                    @endforeach --}}
                                    <option value="">{{ __('frontend.select') }}</option>
                                    <option value="1">{{ __('frontend.less_than') }} 1 {{ __('frontend.kg') }}</option>
                                    <option value="5">{{ __('frontend.less_than') }} 5 {{ __('frontend.kg') }}</option>
                                    <option value="10">{{ __('frontend.less_than') }} 10 {{ __('frontend.kg') }}</option>
                                    <option value="20">{{ __('frontend.less_than') }} 20 {{ __('frontend.kg') }}</option>
                                    <option value="30">{{ __('frontend.less_than') }} 30 {{ __('frontend.kg') }}</option>
                                    <option value="40">{{ __('frontend.less_than') }} 40 {{ __('frontend.kg') }}</option>
                                    <option value="50">{{ __('frontend.less_than') }} 50 {{ __('frontend.kg') }}</option>
                                    <option value="60">{{ __('frontend.more_than') }} 50 {{ __('frontend.kg') }}</option>
                                </select>
                            </div>
                        </div>
                        @isset($products__)
                        <?php  $products = $products__?>
                    @endisset
                        <div class="col-lg-4 col-md-4">
                            <div class="filter__found"
                                style="direction: {{ app()->getLocale() == 'ar' ? 'rtl':'ltr' }}">
                                <h6><span id="count" style="text-align: center">{{ $products->count() }}</span> {{ __('frontend.Products found') }}
                                </h6>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="row product_filter" id="products" style="display: flex">
                  
                    @foreach ($products as $product)
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        @include('pages.shop.product-card')
                    </div>
                    @endforeach

                    
                    <div class="col-lg-12">
                        <div id="pagination-container">
                          {!! $products->links() !!}
                        </div>
                    </div>
                </div>
               
            </div>

        </div>
    </div>
</section>
@endsection
@push('scripts')
<script>
    $(document).ready(function(){
    var ul = $('.filter__sort').find('.list');
    var li =ul.find('li')
    var token = $("meta[name='csrf-token']").attr("content");
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const category = urlParams.get('category')
    li.on('click',function(){
        var action='';
        if(window.location.href == window.location.origin+'/en' || window.location.href == window.location.origin+'/ar'){
             window.location.href = action;
         }
        var value = parseFloat($(this).attr('data-value'))
     
    $.ajax({
      url:action+`/shop/search?wight=${value}&category=${category}`,
     type: 'GET',
     data: {_token: token },
     dataType: 'JSON',
    // dataType: "json",
     success: function (response) {
         if(window.location.href == window.location.origin+'/en' || window.location.href == window.location.origin+'/ar'){
             window.location.href = action;
         }
     $('#products').html(' ')
      $('#count').html(' ')
      $('#products').append(response.html)
      $('#count').append(response.count)
     },
     error: function (err) {
        console.log(err);
     },
 });
    })
  })
</script>

@endpush