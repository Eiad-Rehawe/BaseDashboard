@extends('layouts.frontend')
@push('name')
{{ __('frontend.compare')}}
@endpush
{{-- @push('category')
{{ __('frontend.compare') }}
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
<section class="product-details spad">
  <div class="container">
    <div class="row">

     
    </div>
      <div class="row d-flex justify-content-center">
        <div class="col-lg-6 col-md-6 col-sm-6 col-6" id="product_1_image" style="border :1px solid #7fad39">

        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-6" id="product_2_image" style="border :1px solid #7fad39">

        </div>
      </div>

      <div class="row">
        {{-- <div class="col-6"> --}}
          {{-- <div class="card-body"> --}}
            <div class="table-responsive col-lg-6 col-md-6 col-sm-6 col-12" style="border :1px solid #7fad39">
              <table class="table border text-nowrap customize-table mb-0 align-middle" id="table_1" style="border :1px solid #7fad39;direction:{{ app()->getLocale() == 'ar' ? 'rtl':'ltr' }}">
               <tr>
             
                <th colspan="2">
                  <div class="custom-select-wrapper" style="{{ app()->getLocale() == 'ar' ? 'text-align:right':'' }};border :1px solid #7fad39">
                    <input type="text" class="custom-select_3" placeholder="{{ __('frontend.Select an category') }}" readonly name="" style="{{ app()->getLocale() == 'ar' ? 'text-align:right':'' }}"
                      >
                    <div class="select-dropdown_3">
                      <input type="text" class="select-search_3" placeholder="{{ __('frontend.search') }}" style="{{ app()->getLocale() == 'ar' ? 'text-align:right':'' }}">
                      <div class="select-options_3" id="category_1">
                        @foreach ($categories as $cp)
                        <option class="select-option_3" onclick="select_category_1(this)" value="{{ $cp->id }}" style="{{ app()->getLocale() == 'ar' ? 'text-align:right':'' }}">{{ app()->getLocale() == 'ar' ? $cp->name_ar :
                          $cp->name_en }}</option>
                        @endforeach
          
                      </div>
                    </div>
                  </div>
                </th>
               </tr>
               <tr>
                <th colspan="2">
                  <div class="custom-select-wrapper" style="{{ app()->getLocale() == 'ar' ? 'text-align:right':'' }};border :1px solid #7fad39">
                    <input type="text"  class="custom-select_1" placeholder="{{ __('frontend.Select an option') }}" readonly name="product_id" style="{{ app()->getLocale() == 'ar' ? 'text-align:right':'' }};"
                      >
                    <div class="select-dropdown_1" style="border :1px solid #7fad39;border-radius:10px;text-align">
                      <input type="text" class="select-search_1" placeholder="{{ __('frontend.search') }}" style="{{ app()->getLocale() == 'ar' ? 'text-align:right':'' }};">
                      <div class="select-options_1" id="product_1">
                        <option value=" "  class="select-option_1" onclick="select_product_1(this)" style="margin: 10px">{{ __('frontend.no_thing') }}</option>
                        @foreach ($products as $cp)
                        
                        <option class="select-option_1" onclick="select_product_1(this)" value="{{ $cp->id }}" style="{{ app()->getLocale() == 'ar' ? 'text-align:right':'' }}">{{ app()->getLocale() == 'ar' ? $cp->name_ar :
                          $cp->name_en }}</option>
                        @endforeach
          
                      </div>
                    </div>
                  </div>
                </th>

               </tr>
                <tr>
                  <th>{{ __('frontend.Price') }}</th>
                  <td id="price" style="text-wrap: pretty;"></td>
                </tr>
                <tr>
                  <th>{{ __('frontend.descrption') }}</th>
                  <td id="descrption" style="text-wrap: pretty;"></td>
                </tr>
                <tr>
                  <th>{{ __('frontend.Weight') }}</th>
                  <td id="Weight" style="text-wrap: pretty;"></td>
                </tr>
                <tr>
                  <th>{{ __('frontend.Weight_m') }}</th>
                  <td id="Weight_m" style="text-wrap: pretty;"></td>
                </tr>
                
              </table>
            </div>
          {{-- </div> --}}
        {{-- </div> --}}
        {{-- <div class="col-6"> --}}
          {{-- <div class="card-body"> --}}
            <div class="table-responsive col-lg-6 col-md-6 col-sm-6 col-12" style="border :1px solid #7fad39">
              <table class="table border text-nowrap customize-table mb-0 align-middle" id="table_2" style="border :1px solid #7fad39;direction:{{ app()->getLocale() == 'ar' ? 'rtl':'ltr' }}">
             <tr>
             

              <th colspan="2">
                <div class="custom-select-wrapper" style="{{ app()->getLocale() == 'ar' ? 'text-align:right':'' }};border :1px solid #7fad39">
                  <input type="text" class="custom-select_4" placeholder="{{ __('frontend.Select an category') }}" readonly name="" style="{{ app()->getLocale() == 'ar' ? 'text-align:right':'' }}"
                    >
                  <div class="select-dropdown_4">
                    <input type="text" class="select-search_4" placeholder="{{ __('frontend.search') }}" style="{{ app()->getLocale() == 'ar' ? 'text-align:right':'' }}">
                    <div class="select-options_4" id="category_2">
                      @foreach ($categories as $cp)
                      <option class="select-option_4" onclick="select_category_2(this)" value="{{ $cp->id }}" style="{{ app()->getLocale() == 'ar' ? 'text-align:right':'' }}">{{ app()->getLocale() == 'ar' ? $cp->name_ar :
                        $cp->name_en }}</option>
                      @endforeach
        
                    </div>
                  </div>
                </div>
              </th>
             </tr>
             <tr>
              <th colspan="2">
                <div class="custom-select-wrapper" style="{{ app()->getLocale() == 'ar' ? 'text-align:right':'' }};border :1px solid #7fad39">
                  <input type="text" class="custom-select_2" placeholder="{{ __('frontend.Select an option') }}" readonly name="product_id" style="{{ app()->getLocale() == 'ar' ? 'text-align:right':'' }}"
                    >
                  <div class="select-dropdown_2">
                    <input type="text" class="select-search_2" placeholder="{{ __('frontend.search') }}" style="{{ app()->getLocale() == 'ar' ? 'text-align:right':'' }}">
                    <option value=" "  class="select-option_2" onclick="select_product_2(this)" style="margin: 10px">{{ __('frontend.no_thing') }}</option>

                    <div class="select-options_2" id="product_2">
                      @foreach ($products as $cp)
                      <option class="select-option_2" onclick="select_product_2(this)" value="{{ $cp->id }}" style="{{ app()->getLocale() == 'ar' ? 'text-align:right':'' }}">{{ app()->getLocale() == 'ar' ? $cp->name_ar :
                        $cp->name_en }}</option>
                      @endforeach
        
                    </div>
                  </div>
                </div>
              </th>
             </tr>
                <tr>
                  <th>{{ __('frontend.Price') }}</th>
                  <td id="price" style="text-wrap: pretty;"></td>
                </tr>
                <tr>
                  <th>{{ __('frontend.descrption') }}</th>
                  <td id="descrption" style="text-wrap: pretty;"></td>
                </tr>
                <tr>
                  <th>{{ __('frontend.Weight') }}</th>
                  <td id="Weight" style=""></td>
                </tr>
                <tr>
                  <th>{{ __('frontend.Weight_m') }}</th>
                  <td id="Weight_m" style="text-wrap: pretty;"></td>
                </tr>
              </table>
            </div>
          {{-- </div> --}}
        {{-- </div> --}}
      </div>
    </div>
</section>
@endsection
@push('scripts')
<script src="{{ asset('assets/frontend/custom/search_select.js') }}"></script>
<script src="{{ asset('assets/frontend/custom/compare.js') }}"></script>
@endpush