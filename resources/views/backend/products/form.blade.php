@extends('backend.includes.form')
@section('table-name')
  الأقسام
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
        <label for="name">اسم المنتج</label>
        <input type="text" class="form-control" placeholder="Name" name="name" value="{{ $row->name ?? old('name') }}"/>
        <div id="input-name" style="color: red"></div>

      </div>
      <div class="mb-3 col-md-3">
        <label for="quantity">الكمية</label>
        <input type="number" class="form-control" placeholder="Quantity" name="quantity" value="{{ $row->quantity ?? old('quantity') }}"/>
        <div id="input-quantity" style="color: red"></div>

      </div>
      <div class="mb-3 col-md-3">
        <label for="email">القسم </label>
        <select name="category_id" class="select2 form-control custom-select" >
          <option>Select</option>
          <optgroup label="">
            @foreach ($rows as $category)
            <option value="{{ $category->id }}" {{ isset($row) ? ($row->id == $category->id ? 'selected' :
              ''):(old('id')) }}>{{ $category->name }}</option>
            @endforeach

          </optgroup>

        </select>
        <div id="input-category_id" style="color: red"></div>

      </div>
      <div class="mb-3 col-md-3">
        <label for="email">الماركة </label>
        <select name="category" class="select2 form-control custom-select">
          <option>Select</option>
          <optgroup label="">
            @foreach ($brands as $brand)
            <option value="{{ $brand->id }}" {{ isset($row) ? ($row->id == $brand->id ? 'selected' :
              ''):(old('id')) }}>{{ $brand->name }}</option>
            @endforeach

          </optgroup>

        </select>
        <div id="input-brand_id" style="color: red"></div>

      </div>
      <div class="mb-3 col-md-3">
        <label for="price">السعر</label>
        <input class="form-control" type="text" name="price" value="{{ $row->price ?? old('price') }}">
        <div id="input-price" style="color: red"></div>

      </div>
      <div class="mb-3 col-md-3">
        <label for="image">الصورة</label>
        <input class="form-control" type="file" id="formFile" name="image[]" multiple>
        <div id="input-image" style="color: red"></div>

      </div>
      <div class="row">
        <label for="email">الوصف </label>

        <textarea id="mymce" name="descrption" >{{ $row->descrption ?? old('descrption') }}</textarea>
        <div id="input-descrption" style="color: red"></div>

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