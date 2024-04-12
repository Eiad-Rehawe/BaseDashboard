@extends('backend.includes.form')
@section('table-name')
  مواصقات المنتج
@endsection
@section('form')
@isset($row)
<form action="{{ route('backend.'.rules().'.update',$row->id) }}" method="post" enctype="multipart/form-data"
  class="submit-form">
  @csrf
  @method('put')
  @else
  <form action="{{ route('backend.'.rules().'.store') }}" method="post" enctype="multipart/form-data"
    class="submit-form">
    @csrf
    @method('post')
    @endisset
 

    <div class="row">
      <div class="mb-3 col-md-3">
        <label for="name">الصفة</label>
        <input type="text" class="form-control" placeholder="Name" name="name" value="{{ $row->name ?? old('name') }}"/>
        <div id="input-name" style="color: red"></div>

      </div>
      <div class="mb-3 col-md-3">
        <label for="name">الفيمة</label>
        <input type="text" class="form-control" placeholder="Value" name="value" value="{{ $row->value ?? old('value') }}"/>
        <div id="input-value" style="color: red"></div>

      </div>
      <div class="mb-3 col-md-3">
        <label for="email"> المنتج</label>
        <select name="product_id" class="select2 form-control custom-select">
          <option value=""></option>
          <optgroup label="">
            @foreach ($products as $product)
            <option value="{{ $product->id }}"  {{ isset($row) ? ($row->id == $product->id ? 'selected' :
              ''):(old('id')) }}>{{ $product->name }}</option>
            @endforeach

          </optgroup>

        </select>
        <div id="input-product_id" style="color: red"></div>

      </div>
     
      <div class="mb-3 col-md-12">
        <button class="
          btn
          rounded-pill
          px-4
          bg-success-subtle
          text-success
          font-weight-medium
          waves-effect waves-light
        " type="submit" style="float:left">
          <i class="ti ti-send fs-5"></i>
          Submit
        </button>
        
      </div>
    </div>
  </form>
  @endsection