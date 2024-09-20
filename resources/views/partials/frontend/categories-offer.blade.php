
@if(!empty($offers_category))
<section class="latest-product spad">
    <div class="container">
<div class="product__discount">
    <div class="section-title product__discount__title"
        style="text-align:{{ app()->getLocale() == 'ar' ? 'right':'left' }}">
        <h2 >{{ __('frontend.Categories Offers') }}</h2>
    </div>
    <div class="row">
        <div class="product__discount__slider owl-carousel">
            @foreach ($offers_category as $offer)
            <div class="col-lg-4">
                <div class="product__discount__item">
                    <div class="categories__item " style="background:url('{{$offer->category->files()->first()->category_url ?? ''}}');backgound-repeat:no-repeat;background-size:cover">
                        <h5><a href="{{ route('shop.search',['category'=>$offer->category->id]) }}" id="search-link">{{ app()->getLocale() == 'ar' ? $offer->category->name_ar : $offer->category->name_en }}</a></h5>
                    
                        <?php $result =$offer->Percentage_discount?>
                        @if(!empty($offer->Percentage_discount ))
                        @if($result !=0)
                        <div class="product__discount__percent"  style="  height: 45px;
                        width: 45px;
                        background: #dd2222;
                        border-radius: 50%;
                        font-size: 14px;
                        color: #ffffff;
                        line-height: 45px;
                        text-align: center;
                        position: absolute;
                        left: 15px;
                        top: 15px;">
                            {{$result}}%
                        </div>
                        @endif
                       
                        @endif
                        
                    </div>
          
                  
            </div>
          
          

        </div>
        @endforeach
    </div>
</div>

    </div>
</section>
@else
<div style="text-align: center">{{ __('frontend.not_found') }}</div>
@endif
