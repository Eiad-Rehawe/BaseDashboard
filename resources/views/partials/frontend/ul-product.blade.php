<ul class="featured__item__pic__hover item__pic" id="{{ $product->id }}">
    <li ><a @auth href="{{ route('favourite',['id'=>$product->id]) }}" data-id="{{ $product->id }}"     @else  href="{{ route('getProductWhenClickCart',$product->id) }}"  class="{{$product->id}}"  @endauth   id="heart-btn-new"><i class="fa fa-heart"></i></a></li>
    <li><a id="view" href="{{ route('front.product',$product->id) }}"><i
                class="fa fa-eye"></i></a></li>
        <li><a href="{{ route('getProductWhenClickCart',$product->id) }}" id="add-cart-new">
            <i class="fa fa-shopping-cart"></i>
        </a></li>
    <li id="destroy" class="destroy_{{ $product->id }}"
        style="display:none"><a href="" class="destroy"
            id="{{ $product->id }}"><i class="fa fa-trash"></i></a></li>
</ul>