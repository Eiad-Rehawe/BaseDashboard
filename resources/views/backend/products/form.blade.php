@extends('backend.includes.form')
@section('table-name')
<?php $v = request()->segment(3) ?>
<h4 class="fw-semibold mb-8">{{__("sidebar.$v") }}</h4>
@endsection

@section('form')

@isset($row)
<form action="{{ route('backend.'.request()->segment(3) .'.update',$row->id) }}" method="post"
  enctype="multipart/form-data" class="submit-form">
  @csrf
  @method('put')
  @else
  <form action="{{ route('backend.'.request()->segment(3) .'.store') }}" method="post" enctype="multipart/form-data"
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
        <label for="quantity">{{ __('table.quantity') }}</label>
        <input type="number" class="form-control" placeholder="{{ __('table.quantity') }}" name="quantity"
          value="{{ $row->quantity ?? old('quantity') }}" />
        <div id="input-quantity" style="color: red"></div>

      </div>
      {{-- <div class="mb-3 col-md-3">
        <label for="quantity">{{ __('table.barcode_id') }}</label>
        <input type="text" class="form-control" placeholder="{{ __('table.barcode_id') }}" name="barcode_id"
          value="{{ $row->barcode_id ?? old('barcode_id') }}" />
        <div id="input-barcode_id" style="color: red"></div>

      </div> --}}
      <div class="mb-3 col-md-3">
        <label for="size">{{__('table.Size')}}</label>
        <select name="size_id" class="select2 form-control custom-select">
          <option></option>
          <optgroup label="">
            @foreach ($sizes as $size)
              <option value="{{$size->id}}" {{isset($row) ? ($row->size_id == $size->id ? 'selected' : 
              '') :(old('id')) }}>{{$size->size }}</option>
            @endforeach
          </optgroup>
        </select>
      </div>
      
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
        <label for="price">{{ __('table.purchasing_price') }}</label>
        <input class="form-control" type="number" name="purchasing_price"
          placeholder="{{ __('table.purchasing_price') }}"
          value="{{ $row->purchasing_price ?? old('purchasing_price') }}">
        <div id="input-purchasing_price" style="color: red"></div>

      </div>
      <div class="mb-3 col-md-3">
        <label for="price">{{ __('table.selling_price') }}</label>
        <input class="form-control" type="number" name="selling_price" placeholder="{{ __('table.selling_price') }}"
          value="{{ $row->selling_price ?? old('selling_price') }}">
        <div id="input-selling_price" style="color: red"></div>

      </div>
      <div class="mb-3 col-md-3">
        <label for="price">{{ __('table.new_selling_price') }}</label>
        <input class="form-control" type="number" name="new_selling_price" placeholder="{{ __('table.new_selling_price') }}"
          value="{{ $row->new_selling_price ?? old('new_selling_price') }}">
        <div id="input-new_selling_price" style="color: red"></div>

      </div>
      <div class="mb-3 col-md-3">
        <label for="image">{{ __('table.image') }}</label>
        <input class="form-control" type="file" id="formFile" name="image[]" accept="image/*" multiple>
        <div id="input-image" style="color: red"></div>
        @isset($row)
        @foreach($row->files as $file)
        <img src="{{$row->files()->first()->file_url}}" alt="" height="100" width="100">
        @endforeach
        @endisset

      </div>
      <div class="mb-3 col-md-3">
        <label for="image">{{ __('table.weight') }}</label>
        <input class="form-control" type="number" name="wight" placeholder="{{ __('table.weight') }}"
          value="{{ $row->purchasing_price ?? old('purchasing_price') }}">
        <div id="input-wight" style="color: red"></div>

      </div>
      <div class="mb-3 col-md-3">
        <label for="image">{{ __('table.weight_measurement_ar') }}</label>
        <select name="weight_measurement_id" id="" class="form-control require">
          <option ></option>
          @forelse($w_ms as $w_m)
          <option value="{{ $w_m->id }}" @isset($row) {{ $w_m->id == $row->weight_measurement_id ? 'selected':'' }}
            @endisset>{{ $w_m->name }}</option>
          @empty
          <option value="" disabled>empty</option>
          @endforelse
        </select>
        <div id="input-weight_measurement_id" style="color: red"></div>

      </div>
      
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
  <script src="{{ asset('assets/dashboard/libs/ckeditor/ckeditor.js') }}"></script>
  <script src="{{ asset('assets/dashboard/libs/ckeditor/samples/js/sample.js') }}"></script>
  <script src="{{ asset('assets/dashboard/js/plugins/ckeditor-init.js') }}"></script>
  @endpush