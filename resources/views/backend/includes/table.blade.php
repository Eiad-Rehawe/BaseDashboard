@extends('layouts.app')
@push('style')
<link rel="stylesheet" href="//cdn.datatables.net/2.0.3/css/dataTables.dataTables.min.css">
<link href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/buttons/3.0.1/css/buttons.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/responsive/3.0.1/css/responsive.dataTables.min.css" rel="stylesheet">
@endpush
@section('content')

<div class="container-fluid" >
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">{{ request()->segment(2) }}</h4>
                   
                </div>
                <div class="col-3">
                    <div class="text-center mb-n5">
                        <img src="{{ asset('assets/dashboard/images/breadcrumb/ChatBc.png') }}" alt=""
                            class="img-fluid mb-n4" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="datatables">
        <div class="row">
            <div class="col-12">
                <!-- ---------------------
                            start Scroll - Vertical, Dynamic Height
                        ---------------- -->
                <div class="card">
                    <div class="card-body">
                        @if(request()->segment(2) != 'users' && request()->segment(2) != 'comments')
                        <div class="mb-2">
                            <a href="{{ route('backend.'.request()->segment(2).'.create') }}" type=""
                                class="btn rounded-pill waves-effect waves-light btn-primary">
                                إضافة
                            </a>
                        </div>
                        @endif
                        <div class="mb-2">
                            <a href="{{ route('backend.'.request()->segment(2).'.multi-delete') }}" type=""
                                class="btn rounded-pill waves-effect waves-light btn-danger multi-delete" data-method="post" >
                                Multi Delete
                            </a>
                        </div>
                        
                        <div class="table-responsive">
                            @yield('table')
                            {!! $dataTable->table(['class' => 'table table-bordered'], true) !!}
                        </div>
                    </div>
                </div>
                <!-- ---------------------
                            end Scroll - Vertical, Dynamic Height
                        ---------------- -->
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script src="//cdn.datatables.net/2.0.3/js/dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>


{!! $dataTable->scripts() !!}



@endpush