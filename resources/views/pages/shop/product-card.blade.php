<div class="product__item" id="product_item">
    @if(!empty($product->new_selling_price))
    <?php $price = $product->new_selling_price ?>
    @else
    <?php $price = $product->selling_price ?>
    @endif
    <div class="product__item__pic set-bg" id="{{ $product->id }}"
    @if(request()->segment(2) == 'compare')style="background:url('{{  $product->files()->first() != null ? $product->files()->first()->file_url : ''}}'); background-repeat: no-repeat;
    text-align: center;background-size: cover;" @else  data-setbg="{{  $product->files()->first() != null ? $product->files()->first()->file_url : ''}}" @endif>
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
    <ul class="product__item__pic__hover item__pic" id="{{ $product->id }}" style="direction: {{ app()->getLocale() == 'ar' ? 'rtl':'ltr' }}">
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
    <div class="product__item__text product__discount__item__text">

        <h6><a href="{{ route('front.product',$product->id) }}">{{ app()->getLocale() == 'ar' ? $product->name_ar : $product->name_en}}</a></h6>
        @if(!empty($product->new_selling_price))
        <div class="product__item__price">{{ $product->new_selling_price }} <span>{{ $product->selling_price }}</span>
        </div>
        @else
        <div class="product__item__price">{{ $product->selling_price }} </div>

        @endif
    </div>
</div>