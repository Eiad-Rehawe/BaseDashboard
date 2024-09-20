

 <div class="col-lg-3">
    <div class="hero__categories" style="text-align:{{ app()->getLocale() == 'ar' ? 'right' : 'left'}};direction:{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr'}};">
        <div class="hero__categories__all" >
            <i class="fa fa-bars" ></i>
            <span >{{ __('frontend.All departments') }}</span>
        </div>
        <ul style="border: 5px solid #7fad39;   background-image: linear-gradient(to right,#7fad39,#fff);
 
">  
            @foreach ($categories as $cat)
            <li ><a href="{{ route('shop.search',['category'=>$cat->id]) }}" id="search-link" style="font-weight: bold;margin:10px">{{ app()->getLocale() == 'ar' ? $cat->name_ar : $cat->name_en }}</a></li>
            @if(count($cat->children) > 0)
            <nav aria-label="breadcrumb d-flex">
                <ol class="breadcrumb"  >
                
                    @foreach ($cat->children as $child)
                    <li style="    border-bottom: 1px solid #fff;display:block;width:100%"><a  href="{{ route('shop.search',['category'=>$child->id]) }}" id="search-link">{{ app()->getLocale() == 'ar' ? $child->name_ar : $child->name_en }}</a>
                     
                    </li>
                    @endforeach
               
                
                </ol>
              </nav>
              @endif
            @endforeach
           
      
        </ul>
       
     
    </div>
</div> 
