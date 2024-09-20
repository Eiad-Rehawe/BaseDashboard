<section class="categories">
    <div class="container">
        <div class="row">
            <div class="categories__slider owl-carousel">
                @foreach ($categories as $cat)
                <div class="col-lg-3">
                    
                    <div class="categories__item " data-setbg="{{ $cat->files()->first()->category_url }}"    style="background:url('{{$cat->files()->first()->category_url ?? ''}}');backgound-repeat:no-repeat;background-size:cover">
                        <h5><a href="{{ route('shop.search',['category'=>$cat->id]) }}" id="search-link">{{ app()->getLocale() == 'ar' ?$cat->name_ar : $cat->name_en }}</a></h5>
                    </div>
                </div> 
                @endforeach
               
               
            </div>
        </div>
    </div>
</section>