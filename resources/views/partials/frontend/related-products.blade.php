
<section class="related-product">
    <div class="container">
        <div class="row" >
            <div class="col-lg-12">
                <div class="section-title related__product__title">
                    <h2>{{ __('frontend.Related Product') }}</h2>
                </div>
            </div>
        </div>
        <div class="row" style="direction: {{ app()->getLocale() == 'ar' ? 'rtl':'ltr' }}">
            @foreach ($related_products as $product)
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="product__item">
                    <div class="product__item__pic set-bg" id="{{ $product->id }}"
                        data-setbg="{{  $product->files()->first() != null ? $product->files()->first()->file_url : ''}}">
                        <?php $result =(int)($product->selling_price -$product->new_selling_price)  / ($product->selling_price ) * 100?>
                        @if($result !=0 && $product->new_selling_price != null)
                         <div class="product__discount__percent" style="  height: 45px;
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
                          {{round($result, 2)}}%
                         </div>
                        
                         @endif
                        
                        <ul class="product__item__pic__hover item__pic" style="@if(app()->getLocale() == 'ar') 'margin-right: 25px' @endif @if(app()->getLocale() == 'en') 'margin-left: 25px' @endif" id="{{ $product->id }}" >
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
                    <div class="product__item__text">
                        <h6><a href="#">{{ app()->getLocale() == 'ar' ? $row->name_ar :$row->name_en }}</a></h6>
                       @if(!empty($product->new_selling_price))
                       <h5>{{ $product->selling_price }}</h5><span style="text-decoration:line-through;">{{ $product->new_selling_price }}</span>
                       @else
                       <h5>{{ $product->selling_price }}</h5>
                       @endif
                    </div>
                    </div>
                </div>
            </div>
            @endforeach
           
            
        </div>
    </div>
</section>