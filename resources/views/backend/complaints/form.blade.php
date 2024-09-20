@extends('backend.includes.form')
@section('table-name')
<?php $v = request()->segment(3) ?>
<h4 class="fw-semibold mb-8">{{__("sidebar.$v") }}</h4>
@endsection
@section('form')


<div class="card">
    <div class="card-body wizard-content">

        @isset($row)
        
        <form action="{{ route('backend.'.request()->segment(3).'.update',$row->id) }}" method="post"
            enctype="multipart/form-data" class="submit-form validation-wizard wizard-circle mt-5">
            @csrf
            @method('put')
            @else
            <form action="{{ route('backend.'.request()->segment(3).'.store') }}" method="post"
                enctype="multipart/form-data" class="submit-form validation-wizard wizard-circle mt-5">
                @csrf
                @method('post')
                @endisset
              
                <div class="row">
                    <label for="complaint_text">{{ __('table.complaint_text') }} </label>
                    <textarea @isset($row)
                    readonly
                    @endisset cols="80" id="editor1" name="complaint_text" rows="3" data-sample="2" class="form-control" data-sample-short>{!! $row->complaint_text ?? old('complaint_text') !!}</textarea>
                    <div id="input-complaint_text" style="color: red"></div>
            
                  </div>
                  
                  <div class="mb-3 col-md-12" @isset($row)
                    style="display: none"
                  @endisset>
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
                  
            </form>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('assets/dashboard/libs/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('assets/dashboard/libs/ckeditor/samples/js/sample.js') }}"></script>
<script src="{{ asset('assets/dashboard/js/plugins/ckeditor-init.js') }}"></script>
@endpush