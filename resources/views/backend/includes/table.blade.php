@extends('layouts.app')
@push('style')
<link rel="stylesheet" href="//cdn.datatables.net/2.0.3/css/dataTables.dataTables.min.css">
<link href="https://cdn.datatables.net/buttons/3.0.1/css/buttons.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/responsive/3.0.1/css/responsive.dataTables.min.css" rel="stylesheet">
<meta name="csrf-token" content="{{ csrf_token() }}">

@endpush
@section('content')
<?php
$table;
if(request()->segment(3) == 'admins'){
    $table = 'موظف';
}
if (request()->segment(3) == 'sizes'){
    $table = 'مقاس';
}
if(request()->segment(3) == 'roles'){
    $table = 'صلاحية';
}
if(request()->segment(3) == 'products'){
    $table = 'منتج';
}
if(request()->segment(3) == 'categories'){
    $table = 'قسم';
}
if(request()->segment(3) == 'complaints'){
    $table = 'شكوى';
}
if(request()->segment(3) == 'coupons'){
    $table = 'كوبون';
}
if(request()->segment(3) == 'links'){
    $table = 'لينك';
}
if(request()->segment(3) == 'offers'){
    $table = 'عرض';
}
if(request()->segment(3) == 'orders'){
    $table = 'طلب';
}
if(request()->segment(3) == 'users_complaiment')
{
    $table = 'شكاوي الموظفين'; 
}

?>
<div class="container-fluid" style="padding:0%">
    @include('backend.includes.qr')
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <?php $v = request()->segment(3) ?>
                    <h4 class="fw-semibold mb-8">{{__("sidebar.$v") }}</h4>

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
                        {{-- <form action="{{ route('backend.qr_image_all') }}" method="post">
                            @method('post')
                            @csrf
                            <input id="text" type="file" value="http://localhost:8000/" style="width:80%" /><br />
                            <div id="qrcode"></div>
                        </form> --}}

                        @if(request()->segment(3) != 'complaints' && request()->segment(3) != 'users_complaiment' && request()->segment(3) != 'customers'  && request()->segment(3) != 'users' && request()->segment(3) != 'comments' && request()->segment(3) != 'contacts' )


                        <div class="row">
                   
                           

                            {{-- @if(request()->segment(3) != 'complaints') --}}

                            @if(auth()->user()->can('Create '.ucfirst(rtrim(request()->segment(3), "s"))) ||
                            auth()->user()->can( 'إضافة ' .$table))
                            <div class="mb-2 col-md-2">
                                <a href="{{ route('backend.'.request()->segment(3).'.create') }}" type=""
                                    class="btn rounded-pill waves-effect waves-light btn-primary">
                                    {{ __('buttons.create') }}
                                </a>
                            </div>
                            @endif
                            {{-- @endif --}}
                            @if(auth()->user()->can('Delete Multible'))
                            <div class="mb-2 col-md-2">
                                <a href="{{ route('backend.'.request()->segment(3).'.multi-delete') }}" type=""
                                    class="btn rounded-pill waves-effect waves-light btn-danger multi-delete"
                                    data-method="post">
                                    {{ __('buttons.multi_delete') }}
                                </a>
                            </div>
                            @endif
                           @if(request()->segment(3) == 'products')
                           <div class="mb-2 col-md-2">
 
                            <div class="cart-icon-wrapper d-flex justify-content-center text-center" >
                              <i class="fas fa-search"></i>{{ __('frontend.search_with_barcode') }}
                              <input type="file" class="form-control" accept="image/*" id="inputGroupFile" capture>
                          </div>
                          <p id="result"></p>
                          
                          </div>
                           @endif
                              
                        </div>
                        @endif
                        <div class="table-responsive rounded-2 mb-4" style="overflow-x: auto">
                            {{ $dataTable->table([], true) }}
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
<script src="{{ asset('assets/dashboard/custom/qrcode.min.js') }}"></script>
<script src="//cdn.datatables.net/2.0.3/js/dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>


{{ $dataTable->scripts() }}


<script>
    function Barcode(obj){
  
        $('#barcode').modal('show')
        $('#form_barcode').attr('action',window.location.origin+`/en/admin/generate-qr-pdf/${obj.id}`)
    }
</script>
@endpush