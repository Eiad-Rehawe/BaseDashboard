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
        <label for="name">{{ __('table.name') }}</label>
        <input type="text" class="form-control" placeholder="{{ __('table.name') }}" name="name" value="{{ $row->name ?? old('name') }}"/>
        <div id="input-name" style="color: red"></div>

      </div>
      <div class="mb-3 col-md-3">
        <label for="name">{{ __('table.link') }}</label>
        <input type="text" class="form-control" placeholder="{{ __('table.link') }}" name="link" value="{{ $row->link ?? old('link') }}"/>
        <div id="input-link" style="color: red"></div>

      </div>
      <div class="mb-3 col-md-3">
        <label for="email">{{ __('table.icon') }}</label>
        <select name="icon_id" class="select2 form-control custom-select">
          <optgroup label="">
            <option value="">select</option>
            
            @foreach ($icons as $icon)
            <option value="{{ $icon->id }}"  {{ isset($row) ? ($row->icon_id == $icon->id ? 'selected' :
              ''):(old('id')) }}>{{ $icon->name }}</option>
            @endforeach

          </optgroup>

        </select>
        <div id="input-icon_id" style="color: red"></div>

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