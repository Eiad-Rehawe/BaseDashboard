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
                <!-- Step 1 -->
                <h6>{{ __('table.Step') }} 1</h6>
                <section>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name"> {{ __('table.name') }}</label>
                                <input type="text" class="form-control required" placeholder="{{ __('table.name') }}"
                                    name="name" value="{{ $row->name ?? old('name') }}" />
                                <div id="input-name" style="color: red"></div>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name"> {{ __('table.email') }}</label>
                                <input type="email" class="form-control required" placeholder="{{ __('table.email') }}"
                                    name="email" value="{{ $row->email ?? old('email') }}" />
                                    <div id="input-email" style="color: red"></div>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name"> {{ __('table.phone') }}</label>
                                <input type="phone" class="form-control required" placeholder="{{ __('table.phone') }}"
                                    name="phone" value="{{ $row->phone ?? old('phone') }}" />
                                    <div id="input-phone" style="color: red"></div>
                                </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name"> {{ __('table.address') }}</label>
                                <input type="text" class="form-control required" placeholder="{{ __('table.address') }}"
                                    name="address" value="{{ $row->address ?? old('address') }}" />
                                <div id="input-address" style="color: red"></div>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                        <div class="mb-3">
                            <label for="name"> {{ __('table.password') }}</label>
                            <input type="password" class="form-control required"
                                placeholder="{{ __('table.password') }}" name="password"
                                value="" />
                            <div id="input-password" style="color: red"></div>


                        </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name"> {{ __('table.role') }}</label>
                               
                                <select name="role" id="role" class="form-control required">
                                    <option value="" ></option>
                                    @forelse($roles as $rr)
                                        <option value="{{ $rr->id }}" @isset($row)
                                            {{ $rr->id == $row->roles()->first()->id ? 'selected':'' }}
                                        @endisset>{{ $rr->name }}</option>
                                    @empty
                                        <option value="" disabled>{{ __('table.empty') }}</option>
                                    @endforelse
                                </select>
                               
                          
                            <div id="input-role" style="color: red"></div>

                            </div>
                        </div>

                    </div>

                </section>
                <!-- Step 2 -->
                <h6>{{ __('table.Step') }} 2</h6>
                <section>
                    <div class="mb-3">
                        <input type="checkbox" class="checkbox"  >
                        <label>{{ __('table.permissions') }} :</label>
                        @isset($row)
                        <?php $data2_ = $row->permissions; ?>
                        @else
                        <?php $data2_ = []; ?>
                        @endisset
                        
                    <div class="row" id="permissions">
                        @foreach ($data as $d):

                        <div class="col-md-3 c-inputs-stacked">
                            <div class="form-check">
                                <input type="checkbox" id="customRadio16" name="permission_id[]"
                                    class="form-check-input" value="{{ $d->id }}" 
                                    @foreach ($data2_ as $d2):
                                    {{ ($d->permission_id == $d2->permission_id ? 'checked':($d->id == $d2->permission_id  ? 'checked':'')) }}
                                    @endforeach
                                />
                                <label class="form-check-label" for="customRadio16">{{ $d->name }}</label>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    </div>
                </section>
                <!-- Step 3 -->

            </form>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('assets/dashboard/libs/jquery-steps/build/jquery.steps.min.js') }}"></script>
<script src="{{ asset('assets/dashboard/libs/jquery-validation/dist/jquery.validate.min.js') }}"></script>
<script src="{{ asset('assets/dashboard/js/forms/form-wizard.js') }}"></script>

<script>
    $('body').on('change','#role',function(e){
        e.preventDefault()
        var role_id = $(this).val()
        
        $.ajax({
                url: window.location.origin+`/admin/admins_get/permissions?role_id=${role_id}`,
                type: "get",
               
                dataType: "json",
                success:function(response){
                    console.log(response.data2_)
                    console.log(response.data)
                    $('#permissions').html(response.html)
                },
                error:function(error){
                    console.log(error)
                }

            })
    })
    
</script>
@endpush