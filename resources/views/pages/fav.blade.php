@extends('layouts.frontend')
@push('name')
{{ __('frontend.fav') }}
@endpush
{{-- @push('category')
{{ __('frontend.fav') }}
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
<section class="shoping-cart spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="shoping__cart__table">
                    @auth
                    @if(isset($favs) && count($favs) > 0 )
                    <table id="shoping__cart__table">
                        <thead>
                            <tr>
                                <th class="shoping__product">{{ __('frontend.Products') }}</th>
                                <th>{{ __('frontend.Price') }}</th>
                                
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                           @foreach ($favs as $fav)
                  
                           <tr>
                            <td class="shoping__cart__item">
                                <img src="{{ $fav->product->files()->first()->file_url }}" style="width:100px;height:100px" alt="">
                               <a href="{{ route('front.product',$fav->product->id) }}"> <h5>
                                @if (app()->getLocale() == 'ar')
                                    {{ $fav->product->name_ar }}
                                @else
                                {{ $fav->product->name_en }}
                                @endif
                                </h5></a>
                            </td>
                            <td class="shoping__cart__price" id="price__${data[i]['id']}">
                                {{ $fav->product->price() }}
                            </td>
                         
                            <td class="shoping__cart__item__close">
                               <a  id="heart-btn-new" href="{{ route('favourite',['id'=>$fav->product->id]) }}" data-id="{{ $fav->product->id }}" > <span  class="icon_close"></span></a>
                            </td>
                        </tr>
                           @endforeach

                        </tbody>
                    </table>
                    @endif
                    @endauth
                    @if(!auth()->user())
                    <table id="shoping__cart__table">
                        <thead>
                            <tr>
                                <th class="shoping__product">{{ __('frontend.Products') }}</th>
                                <th>{{ __('frontend.Price') }}</th>
                                
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                                

                        </tbody>
                    </table>
                    @endif
                </div>
            </div>
        </div>
      
    </div>
</section>
@endsection
@push('scripts')

<script>
   
    var myData = localStorage.getItem('fav');
    var lang = $(location).attr('pathname');

        lang.indexOf(1);

        lang.toLowerCase();

        lang = lang.split("/")[1];
        var body = $('#shoping__cart__table tbody')
        // $('#shoping__cart__table tbody').html(' ')
       var data = JSON.parse(myData)
       var sum_total =0;
       var name='';
        $(document).ready(function(){
          
          for(let i=0; i<data.length; i++){
            if(lang == data[i]['lang']){
              var qq = 1;
             if(data[i]['qty'] != 1){
              qq = data[i]['qty'];
             }
            
             if(lang == 'ar'){
                name = data[i]['name_ar'] 
             }if(lang == 'en'){
                name = data[i]['name_en'] 
             }
           var href=window.location.origin+`/${lang}/product/${data[i]['id']}`;
      $(body).append(`  <tr>
      <td class="shoping__cart__item">
          <img src="${ window.location.origin + `/uploads//products/${data[i]['image']}`}" style="width:100px;height:100px" alt="">
         <a href="${href}"> <h5>${name}</h5></a>
      </td>
      <td class="shoping__cart__price" id="price__${data[i]['id']}">
      ${data[i]['price']}
      </td>
   
      <td class="shoping__cart__item__close">
         <button id="${data[i]['id']}" class="destroy_fav"> <span  class="icon_close"></span></button>
      </td>
  </tr>`)
 $('.shoping__checkout ul li span').text(' ')




  }}

 
      })
       
    
    
</script>

<script>
    $(document).on('click','#close',function(){
     
        var id_ = $(this).attr('class')
     // Step 1: Retrieve the array from localStorage
        let myArray = JSON.parse(localStorage.getItem('fav')) || [];
        

        myArray.forEach(item => {
            if(item.id == id_){
                myArray.splice(item, 1);
                localStorage.setItem('fav', JSON.stringify(myArray));
            }
            
        });
  
       
        location.reload()
        

       })
    
</script>

@endpush