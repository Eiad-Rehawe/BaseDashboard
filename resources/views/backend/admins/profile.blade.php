@extends('layouts.app')
@section('content')
<div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
    <div class="card-body px-4 py-3">
      <div class="row align-items-center">
        <div class="col-9">
          <h4 class="fw-semibold mb-8">{{ __('sidebar.My Profile') }}</h4>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                <a class="text-muted text-decoration-none" href="{{ route('dashboard') }}">Home</a>
              </li>
              <li class="breadcrumb-item" aria-current="page">{{ __('sidebar.My Profile') }}</li>
            </ol>
          </nav>
        </div>
        <div class="col-3">
          <div class="text-center mb-n5">
            <img src="{{ asset('assets/dashboard/images/breadcrumb/ChatBc.png') }}" alt="" class="img-fluid mb-n4" />
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="card overflow-hidden">
    <div class="card-body p-0">
      <img src="{{ asset('assets/dashboard/images/backgrounds/profilebg.jpg') }}" alt="" class="img-fluid">
      <div class="row align-items-center">
       
        <div class="col-lg-4 mt-n3 order-lg-2 order-1">
          <div class="mt-n5">
            <div class="d-flex align-items-center justify-content-center mb-2">
              <div class="linear-gradient d-flex align-items-center justify-content-center rounded-circle"
                style="width: 110px; height: 110px;" ;>
                <div
                  class="border border-4 border-white d-flex align-items-center justify-content-center rounded-circle overflow-hidden"
                  style="width: 100px; height: 100px;" ;>
                  <img src="{{ asset('assets/dashboard/images/profile/user-1.jpg') }}" alt="" class="w-100 h-100">
                </div>
              </div>
            </div>
            <div class="text-center">
              <h5 class="fs-5 mb-0 fw-semibold">{{ auth()->user()->name }} </h5>
              <p class="mb-0 fs-4">{{ auth()->user()->roles()->first()->name }}</p>
            </div>
          </div>
        </div>
        <div class="col-lg-4 order-last">
          <ul
            class="list-unstyled d-flex align-items-center justify-content-center justify-content-lg-start my-3 gap-3">
          
           
            <li><button class="btn btn-primary" id="change_password" data-toggle="modal" data-target="#exampleModal">{{ __('sidebar.change_my_info') }}</button></li>
          
          </ul>
        </div>
      </div>
     
    </div>
  </div>
  <div class="tab-content" id="pills-tabContent">
    <div class="tab-pane fade show active" id="pills-profile" role="tabpanel"
      aria-labelledby="pills-profile-tab" tabindex="0">
      <div class="row">
        <div class="col-lg-6">
          <div class="card shadow-none border">
            <div class="card-body">
              <h4 class="fw-semibold mb-3">{{ __('sidebar.my_details') }}</h4>
          
              <ul class="list-unstyled mb-0">
                <li class="d-flex align-items-center gap-3 mb-4">
                  <i class="ti ti-briefcase text-dark fs-6"></i>
                  <h6 class="fs-4 fw-semibold mb-0">{{ auth()->user()->roles()->first()->name }}</h6>
                </li>
                <li class="d-flex align-items-center gap-3 mb-4">
                  <i class="ti ti-mail text-dark fs-6"></i>
                  <h6 class="fs-4 fw-semibold mb-0">{{ auth()->user()->email }}</h6>
                </li>
                <li class="d-flex align-items-center gap-3 mb-4">
                  <i class="ti ti-phone text-dark fs-6"></i>
                  <h6 class="fs-4 fw-semibold mb-0">{{ auth()->user()->phone }}</h6>
                </li>
                <li class="d-flex align-items-center gap-3 mb-2">
                  <i class="ti ti-map-pin text-dark fs-6"></i>
                  <h6 class="fs-4 fw-semibold mb-0">{{ auth()->user()->address }}</h6>
                </li>
              </ul>
            </div>
          </div>
        
        </div>
      
      </div>
    </div>
   
  </div>

@endsection
