
<section class="latest-product spad">
    <div class="container">
<div class="product__discount">
    <div class="section-title product__discount__title"
        style="text-align:{{ app()->getLocale() == 'ar' ? 'right':'left' }}">
        <h2>{{ __('frontend.Latest Products') }}</h2>
    </div>
    <div class="row">
        <div class="product__discount__slider owl-carousel">
            @foreach ($latest_products as $product)
            <div class="col-lg-4">
                <div class="product__discount__item">
                    <div class="product__discount__item__pic set-bg" id="{{ $product->id }}"
                        data-setbg="{{ $product->files()->first()->file_url }}">
                        <?php $result =(int)($product->selling_price -$product->new_selling_price)  / ($product->selling_price ) * 100?>
                        @if(!empty($product->new_selling_price ))
                        @if($result !=0)
                        <div class="product__discount__percent">
                            {{round($result, 2)}}%
                        </div>
                        @endif
                       
                        @endif
                        <ul class="product__item__pic__hover item__pic" id="{{ $product->id }}">
                            <li><a @auth href="{{ route('favourite',['id'=>$product->id]) }}" data-id="{{ $product->id }}"     @else  href="{{ route('getProductWhenClickCart',$product->id) }}"  class="{{$product->id}}"  @endauth   id="heart-btn-new"><i class="fa fa-heart"></i></a></li>
                            <li><a id="view" href="{{ route('front.product',$product->id) }}"><i
                                        class="fa fa-eye"></i></a></li>
                                <li><a href="{{ route('getProductWhenClickCart',$product->id) }}" id="add-cart-new">
                                    <i class="fa fa-shopping-cart"></i>
                                </a></li>
                            <li id="destroy" class="destroy_{{ $product->id }}"
                                style="display:none"><a href="display:none" class="destroy"
                                    id="{{ $product->id }}"><i class="fa fa-trash"></i></a></li>
                        </ul>
                    </div>
                    <div class="product__discount__item__text">
                        <span>{{ app()->getLocale() == 'ar' ? $product->name_ar : $product->name_en}}</span>
                        <h5><a href="{{ route('shop.search',['category'=>app()->getLocale() == 'ar' ? $product->category->name_ar : $product->category->name_en]) }}">{{ app()->getLocale() == 'ar' ? $product->category->name_ar : $product->category->name_en ?? '' }}</a></h5>
                        <div class="product__item__price">
                            @if(!empty($product->new_selling_price ))
                            {{ $product->selling_price }}
                            <span>{{
                                $product->new_selling_price }}</span>
                                @else
                                {{
                                    $product->selling_price }}
                                @endif
                                </div>
                    </div>
                </div>
            </div>
            @endforeach


        </div>
    </div>
</div>
@if(count($top_rated_products) > 0)
<div class="section-title product__discount__title"
style="text-align:{{ app()->getLocale() == 'ar' ? 'right':'left' }}">
<h2>{{ __('frontend.Review Products') }}</h2>
</div>
<div class="row">
<div class="product__discount__slider owl-carousel">
    @foreach ($top_rated_products as $product)
    <div class="col-lg-4">
        <div class="product__discount__item">
            <div class="product__discount__item__pic set-bg" id="{{ $product->id }}"
                data-setbg="{{ $product->files()->first()->file_url }}">
                <?php $result =(int)($product->selling_price -$product->new_selling_price)  / ($product->selling_price ) * 100?>
                @if(!empty($product->new_selling_price ))
                @if($result !=0)
                <div class="product__discount__percent">
                    {{round($result, 2)}}%
                </div>
                @endif
               
                @endif
                <ul class="product__item__pic__hover item__pic" id="{{ $product->id }}" style="direction: {{ app()->getLocale() == 'ar' ? 'rtl;' : 'ltr;' }}">
                    <li><a @auth href="{{ route('favourite',['id'=>$product->id]) }}" data-id="{{ $product->id }}"     @else  href="{{ route('getProductWhenClickCart',$product->id) }}"  class="{{$product->id}}"  @endauth   id="heart-btn-new"><i class="fa fa-heart"></i></a></li>
                    <li><a id="view" href="{{ route('front.product',$product->id) }}"><i
                                class="fa fa-eye"></i></a></li>
                        <li><a href="{{ route('getProductWhenClickCart',$product->id) }}" id="add-cart-new">
                            <i class="fa fa-shopping-cart"></i>
                        </a></li>
                    <li id="destroy" class="destroy_{{ $product->id }}"
                        style="display:none"><a href="" class="destroy"
                            id="{{ $product->id }}"><i class="fa fa-trash"></i></a></li>
                </ul>
            </div>
        

            <div class="product__discount__item__text">
                <span>{{ app()->getLocale() == 'ar' ? $product->name_ar : $product->name_en}}</span>
                <h5><a href="{{ route('shop.search',['category'=>app()->getLocale() == 'ar' ? $product->category->name_ar : $product->category->name_en]) }}">{{ app()->getLocale() == 'ar' ? $product->category->name_ar : $product->category->name_en ?? '' }}</a></h5>
                <div class="product__item__price">
                    @if(!empty($product->new_selling_price ))
                    {{ $product->selling_price }}
                    <span>{{
                        $product->new_selling_price }}</span>
                        @else
                        {{
                            $product->selling_price }}
                        @endif
                        </div>
            </div>

        </div>
    </div>
    @endforeach


</div>
</div>
@endif
    </div>
</section>