@extends('layouts.app')
@section('style')
<link rel="stylesheet" href="{{ asset('assets/dashboard/libs/quill/dist/quill.snow.css')}}">  
@endsection
@section('content')
<div class="container-fluid" style="margin-left:0">
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">@yield('table-name')</h4>
                    <nav aria-label="breadcrumb" style="direction:ltr;">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none" href="{{ route('dashboard') }}">الرئيسية</a>
                            </li>
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
    <div class="row">
        <div class="col-12">
          <div class="card">
           
            <div class="card-body">
           
                   
                    @yield('form')
                    
            </div>
          </div>
        </div>
    </div>

</div>
@endsection
@push('scripts')
<script src="{{ asset('assets/dashboard/libs/tinymce/tinymce.min.js') }}"></script>
<script src="{{ asset('assets/dashboard/js/forms/tinymce-init.js')}}"></script>
@endpush