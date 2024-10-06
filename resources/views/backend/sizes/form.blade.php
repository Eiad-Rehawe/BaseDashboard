@extends('backend.includes.form')
@section('table-name')
<?php $v = request()->segment(3) ?>
<h4 class="fw-semibold mb-8">{{__("sidebar.$v") }}</h4>
@endsection
@section('form')
@isset($row)
<form action="{{ route('backend.'.request()->segment(3).'.update',$row->id) }}" method="post" enctype="multipart/form-data"
  class="submit-form">
  @csrf
  @method('put')
  @else
  <form action="{{ route('backend.'.request()->segment(3).'.store') }}" method="post" enctype="multipart/form-data"
    class="submit-form">
    @csrf
    @method('post')
    @endisset
 

    <div class="row">
      <div class="mb-3 col-md-3">
        <label for="name">{{ __('table.name_ar') }}</label>
        <input type="text" class="form-control" placeholder="{{ __('table.name_ar') }}" name="name_ar"
          value="{{ $row->name_ar ?? old('name_ar') }}" />
        <div id="input-name_ar" style="color: red"></div>

      </div>
      <div class="mb-3 col-md-3">
        <label for="name">{{ __('table.name_en') }}</label>
        <input type="text" class="form-control" placeholder="{{ __('table.name_en') }}" name="name_en"
          value="{{ $row->name_en ?? old('name_en') }}" />
        <div id="input-name_en" style="color: red"></div>

      </div>
      <div class="mb-3 col-md-3">
        <label for="email">{{ __('table.Parent_ar') }}</label>
        <select name="parent_id" class="select2 form-control custom-select">
          <optgroup label="">
         
            <option value="0">{{ __('table.no parent') }}</option>
            @foreach ($rows as $category)
            <option value="{{ $category->id }}"  {{ isset($row) ? ($row->id == $category->id ? 'selected' :
              ''):(old('id')) }}>{{ $category->name }}</option>
            @endforeach

          </optgroup>

        </select>
        <div id="input-parent_id" style="color: red"></div>

      </div>

    
      <div class="mb-3 col-md-3">
        <label for="image">{{ __('table.image') }}</label>
        <input class="form-control" type="file" id="formFile"  accept="image/*" name="image[]" multiple>
        <div id="input-image" style="color: red"></div>
        @isset($row)
        @foreach($row->files as $file)
          <img src="{{ $file->category_url }}" alt="" height="100" width="100">
        @endforeach
        @endisset
      
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