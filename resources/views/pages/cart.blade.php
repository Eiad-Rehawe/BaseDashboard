@extends('layouts.frontend')
@push('name')
{{ __('frontend.cart') }}
@endpush
{{-- @push('category')
{{ __('frontend.cart') }}
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
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="shoping__cart__table responsive">
                    <table id="shoping__cart__table">
                        <thead>
                            <tr>
                                <th class="shoping__product">{{ __('frontend.Products') }}</th>
                                
                                <th>{{ __('frontend.Price') }}</th>
                                <th>{{ __('frontend.Quantity') }}</th>
                                <th>{{ __('frontend.Total') }}</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="tbody">


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="shoping__cart__btns">
                    <a href="{{ route('shop') }}" id="update_cart"  class="primary-btn cart-btn cart-btn-left" style="float:{{ app()->getLocale() == 'ar' ? 'right':'left' }};background: #7fad39;color:#fff">{{
                        __('frontend.CONTINUE SHOPPING') }}</a>
                    {{-- <a href="#" class="primary-btn cart-btn cart-btn-right" id="update_cart" style="background: #7fad39;color:#fff"><span
                            class="icon_loading"></span>
                        {{ __('frontend.Upadate Cart') }}</a> --}}
                </div>
            </div>
            {{-- <div class="col-lg-6">
                <div class="shoping__continue">
                    <div class="shoping__discount">
                        <h5>Discount Codes</h5>
                        <form action="{{ route('get_coupon') }}" method="post" id="apply_coupn">
                            @method('post')
                            @csrf
                            <input type="text" placeholder="Enter your coupon code" id="code" name="code" value="">
                            <button type="submit" class="site-btn">APPLY COUPON</button>
                        </form>
                    </div>
                </div>
            </div> --}}
            <div class="col-lg-12">
                <div class="shoping__checkout">
                    <h5>{{ __('frontend.Cart Total') }}</h5>
                    <ul>

                        <li>{{ __('frontend.Total') }} <span
                                style="float:{{ app()->getLocale() == 'ar' ? 'left':'right' }}"></span></li>
                    </ul>
                    <a href="{{ route('checkout') }}" class="primary-btn" id="update_cart" >{{ __('frontend.PROCEED TO CHECKOUT') }}</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@push('scripts')

<script>
    var myData = localStorage.getItem('cart');
    var lang = $(location).attr('pathname');

        lang.indexOf(1);

        lang.toLowerCase();

        lang = lang.split("/")[1];
       var data = JSON.parse(myData)
       var sum_total =0;
       var name='';
       var sum =0;
       var image=''
        $(document).ready(function(){
          
          for(let i=0; i<data.length; i++){
          //  if(lang == data[i]['lang']){
              var qq = 1;
             if(data[i]['qty'] != 1){
              qq = data[i]['qty'];
             }
             if(lang == 'ar'){
                name = data[i]['name_ar'] 
             }if(lang == 'en'){
                name = data[i]['name_en'] 
             }
           
      $('#shoping__cart__table tbody').append(`  <tr>
      <td class="shoping__cart__item">
          <img src="${ window.location.origin + `/uploads//products/${data[i]['image']}`}" alt="" style="width:100px;height:100px">
          <h5>${name}</h5>
      </td>
      <td class="shoping__cart__price" id="price__${data[i]['id']}">
      ${data[i]['price']}
      </td>
      <td class="shoping__cart__quantity">
          <div class="quantity">
              <div class="pro-qty" id="pro-qty_${i}">
                  <input type="number" value="${qq}"  class="${data[i]['price']}" id="qty_${i}" min="1">

                  </div>
          </div>
      </td>
      <td class="shoping__cart__total_${i}" >
          ${data[i]['total']}
      </td>
      <td class="shoping__cart__item__close">
         <button id="${data[i]['id']}" class="destroy"> <span  class="icon_close"></span></button>
      </td>
  </tr>`)
 $('.shoping__checkout ul li span').text(' ')
 sum_total +=parseInt(data[i]['total'] )

 sum += parseInt(data[i]['qty']);

 
 $(`#qty_${i}`).on('change', function(){
  var qty = $(`#qty_${i}`).val();
  var price = $(this).attr('class')
  var total = parseInt(qty*price)
  $(`.shoping__cart__total_${i}`).text(total)
  $(document).on('click','#update_cart',function(e){
   e.preventDefault()
   data[i]['qty'] = qty;
   sum = parseInt(qty)
   data[i]['total'] =total;
    localStorage.setItem('cart', JSON.stringify(data));
    var lang = $(location).attr('pathname');

lang.indexOf(1);

lang.toLowerCase();

lang = lang.split("/")[1];
var msg = '';
if (lang == 'ar') {
  msg = 'تمت تحديث من السلة بنجاح';
}
if (lang == 'en') {
  msg = 'Update Cart Successfully';
}
Swal.fire({
  position: 'top-end', // Positioning the modal in the top-right corner
  title: msg,
  timer: 1000, // 2 seconds
  showConfirmButton: false,
  customClass: {
    popup: 'custom-width' // Applying a custom CSS class to the popup
  },
});
    window.location.href = $(this).attr('href')
      // if(re)
      // swal.fire(response.status,response.title,response.message);

  })
 
 });

  //}
}
$('.customizer-btn span').text(sum)
  $('.shoping__checkout ul li span').text(sum_total)
 
      })
       
    
        
</script>



@endpush