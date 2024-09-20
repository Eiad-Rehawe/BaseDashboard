@extends('backend.includes.form')
@section('table-name')
<?php $v = request()->segment(3) ?>
<h4 class="fw-semibold mb-8">{{__("sidebar.$v") }}</h4>
@endsection
@push('style')
<link rel="stylesheet" href="{{ asset('assets/frontend/css/toggle.css') }}">

@endpush
@section('form')
@isset($row)
<form action="{{ route('backend.'.request()->segment(3) .'.update',$row->id) }}" method="post"
  enctype="multipart/form-data" class="submit-form">
  @csrf
  @method('put')
  @else
  <form action="{{ route('backend.'.request()->segment(3) .'.store') }}" method="post" id="form" enctype="multipart/form-data"
    class="submit-form">
    @csrf
    @method('post')
    @endisset
    <div class="triple-toggle-switch w-50" style="margin-bottom: 20px">
      <input type="radio" id="offer_product" name="toggle" checked>
      <label for="offer_product" id="offer_product" @if(isset($row) && !empty($row->price_discount) && !empty($row->product_id) ) style="background-color:#4caf50" @elseif(!isset($row)) style="background-color:#4caf50;color:#fff" @else style="background-color:#ddd;" @endif>{{ __('table.offer_product') }}</label>
      <input type="radio" id="offer_category" name="toggle">
      <label for="offer_category" id="offer_category" @if(isset($row) && !empty($row->Percentage_discount) && !empty($row->category_id) ) style="background-color:#4caf50;color:#fff" @elseif(!isset($row)) style="background-color:#ddd;" @else style="background-color:#ddd;"  @endif>{{ __('table.offer_category') }}</label>
     
      <div class="toggle-slider"></div>
    </div>

    <div class="row tab-pane" id="offer_product" @if(isset($row) && !empty($row->price_discount) && !empty($row->product_id) ) style="display: block" @elseif(!isset($row)) style="display:block" @else style="display: none" @endif>

      <div class="mb-3 col-md-3">
        <label for="quantity">{{ __('table.product') }}</label>
        <select name="product_id" id="product_id" class="select2 form-control custom-select">
          <option></option>

          <optgroup label="">
            @foreach ($products_rows as $product)
            <option value="{{ $product->id }}" {{ isset($row) ? ($row->product_id == $product->id ? 'selected' :
              ''):(old('id')) }}>{{ $product->name }}</option>
            @endforeach

          </optgroup>

        </select>
      </div>
     @isset($row)
       <?php
       $price=0;
          if(!empty($row->product_id)){
            $price = $row->product->selling_price;
         
        }
       ?>
     @endisset
      <div class="mb-3 col-md-3">
        <label for="email">{{ __('table.price_discount') }}  </label>
       <input type="number" name="price_discount" @isset($row)
       max="{{ $price-1 }}"
       @endisset min="1"  class="form-control" id="price_discount" placeholder="{{ __('table.price_discount') }}" value="{{ $row->price_discount ?? old('price_discount') }}">
       <div id="input-price_discount" style="color: red"></div>

      </div>
    
      </div>
     <div class="row tab-pane" id="offer_category" @if(isset($row) && !empty($row->Percentage_discount) && !empty($row->category_id) ) style="display: block" @else style="display: none" @endif>
    
      <div class="mb-3 col-md-3">
        <label for="email">{{ __('table.category') }} </label>
        <select name="category_id" class="select2 form-control custom-select">
          <option></option>
          <optgroup label="">
            @foreach ($rows as $category)
            <option value="{{ $category->id }}" {{ isset($row) ? ($row->category_id == $category->id ? 'selected' :
              ''):(old('id')) }}>{{ $category->name }}</option>
            @endforeach

          </optgroup>

        </select>
        <div id="input-category_id" style="color: red"></div>

      </div>
      <div class="mb-3 col-md-3">
        <label for="email">{{ __('table.Percentage_discount') }}  </label>
       <input type="number" name="Percentage_discount" class="form-control"  max="100" min="1" placeholder="{{ __('table.Percentage_discount') }}"  value="{{ $row->Percentage_discount ?? old('Percentage_discount') }}">
       <div id="input-Percentage_discount" style="color: red"></div>

      </div>
     </div>
      <div class="mb-3 col-md-12">
        <button class="
          btn
          rounded-pill
          px-4
          btn btn-primary
          font-weight-medium
          waves-effect waves-light
        " type="submit" style="float:left">
          <i class="ti ti-send fs-5"></i>
          {{ __('table.Submit') }}
        </button>

      </div>
    </div>
  </form>
  @endsection
  @push('scripts')
  <script>
    // script.js
var tabs = document.querySelectorAll('.tab-pane')
var lables = document.querySelectorAll('.triple-toggle-switch label')
document.querySelectorAll('.triple-toggle-switch input').forEach(input => {
  input.addEventListener('change', (event) => {
    let id = event.target.id
    lables.forEach(label=>{
        if(label.id == id){
            label.style.backgroundColor = '#4caf50';

        }else{
            label.style.backgroundColor = '';

        }
    })
    tabs.forEach(tab=>{
  if(tab.id == id){
    console.log( tab.style.display)
    tab.style.display='block';

    if (!input.hasAttribute('checked')) {
        input.setAttribute('checked', '');
        }
  }else{
    tab.style.display='none';

    if (input.hasAttribute('checked')) {
        input.removeAttribute('checked');
        }
  }
    })
   
    console.log(`Selected: ${event.target.nextElementSibling.textContent}`);
  });
});

</script>
<script>
  $('body').on('submit','#form',function(e){
    e.preventDefault()
    let product_id = $('#product_id').val()
    let price_discount = $('#price_discount').val()
    $.ajax({
        url: window.location.origin+`/admin/price/validate?product_id=${product_id}&price_discount=${price_discount}`,
        type: "get",
        dataType: 'JSON',
        processData: false,
        contentType: false,
        success: function (data, textStatus, jqXHR, response) {
          console.log(data.msg)
           $('#input-price_discount').text(data.msg)
        },

        error: function (err, data, response, jqXhr, xhr) {
          console.log(err)           

        },

    });
  })
</script>
  @endpush