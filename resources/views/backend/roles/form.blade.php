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
            enctype="multipart/form-data" class="submit-form ">
            @csrf
            @method('put')
            @else
            <form action="{{ route('backend.'.request()->segment(3).'.store') }}" method="post"
                enctype="multipart/form-data" class="submit-form ">
                @csrf
                @method('post')
                @endisset
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="name"> {{ __('table.name_ar') }}</label>
                        <input type="text" class="form-control required" placeholder="{{ __('table.name_ar') }}"
                            name="name_ar" value="{{ $row->name_ar ?? old('name_ar') }}" />
                        <div id="input-name_ar" style="color: red"></div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="name"> {{ __('table.name_en') }}</label>
                        <input type="text" class="form-control required" placeholder="{{ __('table.name_en') }}"
                            name="name_en" value="{{ $row->name_en ?? old('name_en') }}" />
                        <div id="input-name_en" style="color: red"></div>
                    </div>
                   
                </div>
                {{-- <div class="mb-3">
                    <input type="checkbox" class="checkbox"  >
                    <label>{{ __('table.permissions') }} :</label>
                  @isset($row)
                  <?php $data2_ =$row->permissions
                  
                  ?>
                  @endisset
               
                   
                   <div class="row">
                   
                    @foreach ($data as $d)
                   
                    
                    <div class="col-md-3 c-inputs-stacked">
                        <div class="form-check">
                            <input type="checkbox" id="customRadio16" name="permission_id[]"
                                class="form-check-input" value="{{ $d->id }}" @isset($row)
                                @foreach ($data2_ as $d2){{ 
                                ($d->permission_id == $d2->id ? 'checked':($d->id == $d2->id  ? 'checked':'')) 
                                }}  @endforeach
                                @endisset   />
                            <label class="form-check-label" for="customRadio16">{{ $d->name }}</label>
                        </div>

                    </div>
                   
                   
                    @endforeach
                   </div>
                </div> --}}
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
            </form>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('assets/dashboard/libs/jquery-steps/build/jquery.steps.min.js') }}"></script>
<script src="{{ asset('assets/dashboard/libs/jquery-validation/dist/jquery.validate.min.js') }}"></script>
<script src="{{ asset('assets/dashboard/js/forms/form-wizard.js') }}"></script>
@endpush