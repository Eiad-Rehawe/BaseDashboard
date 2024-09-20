<div class="row" style="direction:{{ app()->getLocale() == 'ar' ? 'rtl':'ltr' }}">
  <div class="hero__search col-lg-9 col-md-9 col-sm-9 col-9" style="width: 100%">
    {{-- <div class="row" style="direction:{{ app()->getLocale() == 'ar' ? 'rtl':'ltr' }}"> --}}
    <div class="hero__search__form " >
       
          <form action="{{ route('shop.search') }}" method="get" id="search">
                @csrf
              @method('get')
                <input type="text" id="input-search" class="form-control" name="search" style="color: #000;border:1px solid #7fad39;text-align: {{ app()->getLocale() =='ar' ? 'rtl':'ltr' }};" value="{{ old('search') }}" placeholder="{{ __('frontend.What do yo u need') }}" >
                <button type="submit" class="site-btn" style="border:1px solid #000;">{{ __('frontend.SEARCH') }}</button>
            </form>
            
      
    </div>
  
    {{-- </div> --}}

  

</div>
<div class="col-lg-3 col-md-3 col-sm-3 col-3 your-class">
 
  <div class="cart-icon-wrapper" >
    <i class="fas fa-search"></i>{{ __('frontend.search_with_barcode') }}
    <input type="file" class="form-control" accept="image/*" id="inputGroupFile" capture>
</div>
<p id="result"></p>

</div>

</div>
