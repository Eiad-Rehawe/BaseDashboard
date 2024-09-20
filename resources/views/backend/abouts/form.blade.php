@extends('backend.includes.form')
@section('table-name')
<?php $v = request()->segment(3) ?>
<h4 class="fw-semibold mb-8">{{__("sidebar.$v") }}</h4>
@endsection
@section('form')

  <form action="{{ route('backend.'.request()->segment(3).'.store') }}" method="post" enctype="multipart/form-data"
    class="submit-form">
    @csrf
    @method('post')
  {{-- <input type="hidden" name="id" id="" value="{{ $row->id ?? 1 }}"> --}}
 

    <div class="row">
            
      <div class="row">
        <div class="col-lg-6">
          <label for="email">{{ __('table.descrption_en') }} </label>
          <textarea cols="80" id="editor1" name="descrption_en" rows="3" data-sample="2" class="form-control"
            data-sample-short>{!! $row->descrption_en ?? old('descrption_en') !!}</textarea>
          <div id="input-descrption_en" style="color: red"></div>
        </div>
        <div class="col-lg-6">
          <label for="email">{{ __('table.descrption_ar') }} </label>
          <textarea cols="80" id="editor3" name="descrption_ar" rows="3" data-sample="2" class="form-control"
            data-sample-short>{!! $row->descrption_ar ?? old('descrption_ar') !!}</textarea>
          <div id="input-descrption_ar" style="color: red"></div>
        </div>
      </div>

    
      <div class="mb-3 col-md-3">
        <label for="image">{{ __('table.image') }}</label>
        <input class="form-control" type="file" id="formFile" name="image" accept="image/*" >
        <div id="input-image" style="color: red"></div>
        @isset($row)
       
          <img src="{{ $row->image_url }}" alt="" height="100" width="100">
       
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