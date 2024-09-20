
<section class="featured spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    {{-- <h2>Featured Product</h2> --}}
                </div>
                <div class="featured__controls">
                    <ul id="myList">
                       
                        <li class="active" data-filter="*" id="all">{{ __('frontend.All') }}</li>
                        @foreach ($categories as $cat)
                        <li data-filter="{{ $cat->id }}" id="featured">{{ app()->getLocale() == 'ar' ? ucfirst($cat->name_ar):ucfirst($cat->name_en) }}</li>
                        @endforeach

                    </ul>
                </div>
            </div>
        </div>
        <div id="featured__filter">
        <div class="row featured__filter" >
        
            <input type="hidden" value="{{ count($products) }}" id="count_products">
          
            <?php for($j =0; $j<count($products); $j++) {?>
            <div id="rating_{{ $j }}" class="{{ $products[$j]->id }}" style="display: none"></div>
            <?php }?>
              
            @foreach ($products as $key=>$product)
              
            <div class="col-lg-3 col-md-4 col-sm-6 mix  k_"  
            id="{{ app()->getLocale() == 'ar'  ? $product->category->name_ar : $product->category->name_en}}"
            >
                @if(!empty($product->new_selling_price))
                <?php $price = $product->new_selling_price ?>
                @else
                <?php $price = $product->selling_price ?>
                @endif
              
                <div class="featured__item" id="{{ app()->getLocale() == 'ar'  ? $product->category->name_ar : $product->category->name_en}}" >
                        <div class="featured__item__pic set-bg " id="{{ $product->id }}"
                            data-setbg="{{ $product->files()->first() != null ? $product->files()->first()->file_url : ''}}">
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
                           @include('partials.frontend.ul-product')
    
                        </div>
                

                    <div class="card-body" style="text-align: center">
                        <h5 class="card-title"><a style="color: #000" href="{{ route('front.product',$product->id) }}" >{{ app()->getLocale() == 'ar' ? $product->name_ar : $product->name_en}}</a></h5>

                        <div class="rating_" data-rating="0">
                         
                                <?php $rate=''; ?>
                                @for ($j=0;$j<count($product->ratings); $j++)
                                    <?php $rate=$product->ratings[$j]->avg('rating'); ?>
                                    @endfor
                                @for ($i = 1; $i <= 5; $i++)
                               
                                   @if ($i <= $rate )
                                       <i class="fas fa-star text-warning" data-value="{{ $i }}"></i> <!-- Filled star -->
                                       @else
                                       <i class="far fa-star" data-value="{{ $i }}"></i>
                                       @endif
                                    
                                      
                                      
                                       @endfor
                               
                               
                             

                        </div>

                        <div class="product__item__text product__discount__item__text" >
                           
                            @if(!empty($product->new_selling_price))
                            <div class="product__item__price">{{ $product->new_selling_price }} <span>{{ $product->selling_price }}</span></div>
                            @else
                            <div class="product__item__price">{{ $product->selling_price }} </div>
                    
                            @endif
                        </div>

                        <!-- Add to Cart Button -->

                    </div>


                </div>
               

            </div>


            @endforeach

        </div>
        {!! $products->links() !!}
        </div>
    </div>
</section>