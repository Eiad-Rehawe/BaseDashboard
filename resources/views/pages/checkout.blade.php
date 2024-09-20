@extends('layouts.frontend')

@push('name')
{{ __('frontend.checkout') }}
@endpush
{{-- @push('category')
{{ __('frontend.checkout') }}
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
<section class="checkout spad"
    style="direction:{{ app()->getLocale() == 'ar' ? 'rtl':'ltr' }};text-align:{{ app()->getLocale() == 'ar' ? 'right':'left' }}">
    <div class="container">
        @include('partials.frontend.modal')

        <div class="checkout__form">
            <h4>{{ __('frontend.Billing Details') }}</h4>
            <div id="input-qty" style="color: #fff;background-color:red;text-align:center"></div>

            <form action="{{ route('storeOrder') }}" method="post" id="submit-form-cart">
                @method('post')
                @csrf
                <div class="row">
                    <input type="hidden" name="code" value="" id="code">
                    <input type="hidden" name="total" value="" id="total">
                    <input type="hidden" name="total_after_des" value="" id="total_after_des">
                    <input type="hidden" name="product_id" value="" id="product_id">
                    <input type="hidden"  name="qty" value="" id="qty__" >

                    <div class="col-lg-8 col-md-6">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>{{ __('frontend.Fist Name') }}<span>*</span></p>
                                    <input type="text" name="first_name" value="{{ old('first_name') }}" style="border :1px solid #7fad39;border-radius:10px;text-align:{{ app()->getLocale() == 'ar' ? 'right':'left' }}">
                                    <div id="input-first_name" style="color: red"></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>{{ __('frontend.Last Name') }}<span>*</span></p>
                                    <input type="text" name="last_name" value="{{ old('last_name') }}" style="border :1px solid #7fad39;border-radius:10px;text-align:{{ app()->getLocale() == 'ar' ? 'right':'left' }}">
                                    <div id="input-last_name" style="color: red"></div>
                                </div>
                            </div>
                        </div>
                     
                        <div class="checkout__input">
                            <p>{{ __('frontend.Address') }}<span>*</span></p>
                            <input type="text" name="address_1" value="{{ old('address_1') }}"
                                placeholder="{{ __('frontend.Street Address') }}" class="checkout__input__add" style="border :1px solid #7fad39;border-radius:10px;text-align:{{ app()->getLocale() == 'ar' ? 'right':'left' }}">
                            <div id="input-address_1" style="color: red"></div>
                            <input type="text" name="address_2" value="{{ old('address_2') }}" style="border :1px solid #7fad39;border-radius:10px;text-align:{{ app()->getLocale() == 'ar' ? 'right':'left' }}"
                                placeholder="{{ __('frontend.Apartment') }}, {{ __('frontend.suite') }}, {{ __('frontend.unite') }} .. ({{ __('frontend.optinal') }})">
                            <div id="input-address_2" style="color: red"></div>
                        </div>
                        <div class="checkout__input">
                            <p>{{ __('frontend.City') }}<span>*</span></p>
                            <input type="text" name="city" value="{{ old('city') }}" style="border :1px solid #7fad39;border-radius:10px;text-align:{{ app()->getLocale() == 'ar' ? 'right':'left' }}">
                            <div id="input-city" style="color: red"></div>
                        </div>


                        <div class="row">
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>{{ __('frontend.Phone') }}<span>*</span></p>
                                    <input type="phone" name="phone" value="{{ old('phone') }}" style="border :1px solid #7fad39;border-radius:10px;text-align:{{ app()->getLocale() == 'ar' ? 'right':'left' }}">
                                    <div id="input-phone" style="color: red"></div>

                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>{{ __('frontend.Email') }}<span>*</span></p>
                                    <input type="email" name="email" value="{{ old('email') }}" style="border :1px solid #7fad39;border-radius:10px;text-align:{{ app()->getLocale() == 'ar' ? 'right':'left' }}">
                                    <div id="input-email" style="color: red"></div>
                                </div>
                            </div>
                        </div>

                        <div class="checkout__input">
                            <p>{{ __('frontend.Order notes') }}</p>
                            <input type="text" name="notes" style="border :1px solid #7fad39;border-radius:10px;text-align:{{ app()->getLocale() == 'ar' ? 'right':'left' }}"
                                placeholder="{{ __('frontend.Notes about your order') }}, {{ __('frontend.special notes for delivery') }}."
                                value="{{ old('notes') }}">
                            <div id="input-notes" style="color: red"></div>
                        </div>
                        <button type="button" class="site-btn set_order" style="padding: 10px">{{ __('frontend.PLACE ORDER') }}</button>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                        <div class="checkout__order">
                            <h4>{{ __('frontend.Your Order') }}</h4>
                            <div class="checkout__order__products">{{ __('frontend.Products') }} <span>{{
                                    __('frontend.total') }}</span></div>
                            <ul id="ul_order">

                            </ul>
                            <div class="checkout__order__subtotal" style="display: none">{{
                                __('frontend.total_after_discount') }} <span
                                    style="float: {{ app()->getLocale() == 'ar' ? 'left':'right' }};"></span></div>
                            <div class="checkout__order__total">{{ __('frontend.Total') }} <span
                                    style="float: {{ app()->getLocale() == 'ar' ? 'left':'right' }};"></span></div>



                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
@push('scripts')
@auth
<script>
    const userId = {{ auth()->id() }}
   
</script>

@endauth
<script>
    $(document).ready(function(){
        $('#ul_order').html(' ')
        $('.checkout__order__total').html();
     let myArray = JSON.parse(localStorage.getItem('cart')) || [];
     let sum =0;
        var dd=0
    var cc='';
    var product_id=[];
    var qty__ = [];
    // var qty__=0;
    var qty=0;
    var name =''
    var lang = $(location).attr('pathname');

        lang.indexOf(1);

        lang.toLowerCase();

        lang = lang.split("/")[1];
     myArray.forEach(item => {
       
        if(lang == 'ar'){
                name = item.name_ar
             }if(lang == 'en'){
                name = item.name_en
             }
        sum += parseInt(item.total);
         $('#ul_order').append(`<li>${name} <span style="float: {{ app()->getLocale() == 'ar' ? 'left':'right' }};">${item.total}</span></li>
`)
        dd+=parseInt(item.total_after_coupon)
       
       cc = item.coupon;
       product_id.push(item.id)
       qty__.push(item.qty)
       qty+=parseInt(item.qty)
       $('#qty__').attr('value',qty__)

     });
   
     if(dd != 0){
        $('.checkout__order__subtotal span').text(dd)
     }else{
        $('.checkout__order__subtotal span').text(' ')
     }
     $('.checkout__order__total span').text(sum)
     $('.customizer-btn span').text(qty)
     $('#code').attr('value',' ');
     $('#code').attr('value',cc);
     
    $('#total_after_des').attr('value',dd);
    $('#total').attr('value',sum);
    $('#product_id').attr('value',product_id)
    })
</script>

<script>
    $(document).ready(function() {
        // First form submission
        $('#apply_coupn').on('submit', function(e) {
            e.preventDefault(); // Prevent default form submission

            // Collect data from form1
            var formData1 = $(this).serialize(); // Serialize form data

            $.ajax({
                url:  $('#apply_coupn').attr('action'), // Endpoint to submit form1
                type: 'POST',
                data: formData1, // Data to submit
                success: function(response) {
                    if(response.case == 1){
                        $('#code').attr('value',response.coupon['code']);
                    let myArray = JSON.parse(localStorage.getItem('cart')) || [];
                    var total_afer_des=0;
                    var total___ = 0;
                    myArray.forEach(item => {
                        total_afer_des = parseInt(item.total * response.coupon['value']/100)
                        item.total_after_coupon = total_afer_des 
                        item.coupon =  response.coupon['code']
                        total___ =item.total
                        
                        localStorage.setItem('cart', JSON.stringify(myArray));
                        
                    });
                    $('#apply_coupn').trigger("reset");
                    submitForm2();
                    } if(response.case == 2){
                        $('#code').attr('value',$('#cc').val());
                        submitForm2();
                    }
                   
                },
                error: function(err,jqXHR,response, textStatus, errorThrown) {
                    console.log(response)
                    if(response == 'Forbidden'){
                    var lang = $(location).attr('pathname');
                    lang.indexOf(1);
                    lang.toLowerCase();
                    lang = lang.split("/")[1];
                    if(lang == 'en'){
                        swal.fire('error', 'please verify your email', 'error');
                    }
                    if(lang == 'ar'){
                        swal.fire('خطأ', 'يرجى تأكيد الحساب', 'error');
                    }
                
                }
                    if($('#auth').val() == ''){
                window.location.href = '/login'
            }
            var elem = err.responseText;

            var ss = jQuery.parseJSON('[' + elem + ']');

            $.each(ss[0]['errors'], function (key, value) {

                $(`#input-${key}`).text(value);

            });
                }
            });
        });

        // Function to submit the second form
        function submitForm2() {
            // Collect data from form2
            var formData2 = $('#submit-form-cart').serialize();

            $.ajax({
                url:  $('#submit-form-cart').attr('action'), // Endpoint to submit form2
                type: 'POST',
                data: formData2,
                success: function(response) {
                if(response.status == 'success'){
                    localStorage.clear();
                    swal.fire(response.title, response.message, response.status,window.location = response.redirect);

                }
                if(response.status == 'error'){
                    // localStorage.clear();
                    swal.fire(response.title, response.message, response.status,window.location = response.redirect);

                }
                // if(response.status == 'error'){
                //     swal.fire(response.title, response.message, response.status);

                // }
        
                },
                error: function (err,data,response,jqXHR,xhr) {
                    if(response == 'Not Found'){
                        var lang = $(location).attr('pathname');
                    lang.indexOf(1);
                    lang.toLowerCase();
                    lang = lang.split("/")[1];
                    if(lang == 'en'){
                        swal.fire('error', 'please add products to your cart', 'error');
                    }
                    if(lang == 'ar'){
                        swal.fire('خطأ', 'الرجاء اضف منتجات للسلة', 'error');
                    }
                    }
            //         if($('#auth').val() == ''){
            //     window.location.href = '/login'
            // }
            $('#check_coupon_code').modal('hide')

            var elem = err.responseText;

            var ss = jQuery.parseJSON('[' + elem + ']');

            $.each(ss[0]['errors'], function (key, value) {

                $(`#input-${key}`).text(value);

            });
                    
          
        },
            });
        }
    });
</script>
<script>
    $(document).on('click','.set_order',function(){
        $('#check_coupon_code').modal('show')
    })
</script>
@endpush