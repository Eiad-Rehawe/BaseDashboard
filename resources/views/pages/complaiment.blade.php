@extends('layouts.frontend')
@push('name')
{{ __('frontend.Send a complaint') }}
@endpush


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
<div class="container">
<div class="contact-form spad">
  
  <div class="row">
    <div class="card-body ">
      <form action="{{ route('public.employee.complaiment') }}" style="direction: {{ app()->getLocale() == 'ar' ? 'rtl':'ltr' }};text-align:{{ app()->getLocale() == 'ar' ? 'right':'left' }};" method="post"
        enctype="multipart/form-data" class="submit-form-complaiments validation-wizard wizard-circle mt-5">
        @csrf
        @method('post')
      
        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
            <label for="complaint_text">{{ __('table.complaint_text') }} </label>
            <textarea  style="border :1px solid #7fad39;border-radius:10px;text-align:{{ app()->getLocale() == 'ar' ? 'right':'left' }}" cols="80" id="editor1" name="complaint_text" rows="3" data-sample="2" class="form-control" data-sample-short>{!! $row->complaint_text ?? old('complaint_text') !!}</textarea>
            <div id="input-complaint_text" style="color: red"></div>
    
          </div>
          <div class="col-lg-12 col-md-12 col-sm-12 col-12">
            <label for="complaint_text">{{ __('table.cause_problem') }} </label>
            <input  style="border :1px solid #7fad39;border-radius:10px;text-align:{{ app()->getLocale() == 'ar' ? 'right':'left' }}"  name="cause_problem"  class="form-control" value="{{ old('cause_problem') }}">
            <div id="input-cause_problem" style="color: red"></div>
    
          </div>
   
       
         <div class="form-group">
            <label for="">{{ __('frontend.status_complaiment') }}</label>
            
         
           
            <div class="form-check ">
              <label class="form-check-label">
                <input type="radio" style="width: 15px;height:15px" class="form-check-input" id="public" name="status" value="1" onchange='handleChange1(this);'>   {{ __('frontend.public') }}
            </div> 
           
          <div class="form-check ">
            <label class="form-check-label">
              <input type="radio" style="width: 15px;height:15px" class="form-check-input" name="status" value="0" onchange='handleChange(this);'>   {{ __('frontend.on employee') }}
            </label>
          </div>
         </div>
         <div class="col-lg-12 col-md-12 col-sm-12 col-12 form-group" id="employee_name" style="display:none">
          <label for="complaint_text">{{ __('table.employee_name') }} </label>

            <input type="text"style="border :1px solid #7fad39;border-radius:10px;text-align:{{ app()->getLocale() == 'ar' ? 'right':'left' }}"  name="employee_name" value="{{ old('employee_name') }}" class="form-control">
            <div id="input-employee_name" style="color: red"></div>

          </div>

          <div class="mb-3 col-md-12">
            <button class="
              btn
              rounded-pill
              px-4
              btn btn-success
              font-weight-medium
              waves-effect waves-light
            " type="submit" style="float:center;background:#7fad39;margin-top:20px">
              <i class="ti ti-send fs-5"></i>
              {{ __('table.Submit') }}
            </button>
          
          </div>
          
    </form>
     </div>
  </div>
    </div>
</div>
@endsection
@push('scripts')
    <script>
     
    function handleChange(checkbox) {
    if(checkbox.checked == true){
        document.getElementById("employee_name").style.display='block';
  }else{
      document.getElementById("employee_name").style.display='none';
  }
}
    </script>
     <script>
     
      function handleChange1(checkbox) {
      if(checkbox.checked == true){
          document.getElementById("employee_name").style.display='none';
    }else{
        document.getElementById("employee_name").style.display='block';
    }
  }
      </script>
@endpush