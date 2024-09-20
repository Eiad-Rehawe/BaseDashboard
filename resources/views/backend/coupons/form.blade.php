@extends('backend.includes.form')
@push('style')
<style>
  .dropdown {
  position: relative;
  left: 50px;
  top: 50px;
}
</style>
@endpush
@section('table-name')
<?php $v = request()->segment(3) ?>
<h4 class="fw-semibold mb-8">{{__("sidebar.$v") }}</h4>
@endsection
@section('form')
@isset($row)
<form action="{{ route('backend.'.request()->segment(3).'.update',$row->id) }}" method="post" enctype="multipart/form-data"
  class="submit-form">
  @csrf
  @method('put')
  @else
  <form action="{{ route('backend.'.request()->segment(3).'.store') }}" method="post" enctype="multipart/form-data"
    class="submit-form">
    @csrf
    @method('post')
    @endisset


    <div class="row">
      <div class="mb-3 col-md-3">
        <label for="code">{{ __('table.code') }}</label>
        <input type="text" id="code" class="form-control" placeholder="{{ __('table.code') }}" name="code"
          value="{{ $row->code ?? old('code') }}" />
        <div id="input-code" style="color: red"></div>

      </div>
      <div class="mb-3 col-md-3">
        <label for="name">{{ __('table.value') }}</label>
        <input type="text" class="form-control" placeholder="{{ __('table.value') }}" name="value"
          value="{{ $row->value ?? old('value') }}" />
        <div id="input-value" style="color: red"></div>

      </div>
      <div class="mb-3 col-md-4">
        <label for="user_id">{{ __('table.user_') }}</label>
        <select name="user_id[]"class="select2 form-control block" multiple="multiple">
          <option value=""></option>
          <option value="0">الكل</option>
          @foreach ($users as $user)
          <option value="{{ $user->id }}" @if(isset($row) )
            @foreach ($row->coupon_users as $d)
            {{ ($d->user_id == $user->id ? 'selected' :
            '') }}
          @endforeach 
          @endif
        >{{ $user->first_name }}  {{ $user->last_name }}</option>
          @endforeach
        </select>
        <div id="input-user_id" style="color: red"></div>
      </div>
      
      
      {{-- <div class="mb-3 col-md-3">
        <label for="email">الزبون</label>
        <select name="user_id" class="select2 form-control custom-select">
          <optgroup label="">
            @foreach ($users as $user)
            <option value="{{ $user->id }}" {{ isset($row) ? ($row->id == $user->id ? 'selected' :
              ''):(old('id')) }}>{{ $user->name }}</option>
            @endforeach

          </optgroup>

        </select>
        <div id="input-user_id" style="color: red"></div>

      </div> --}}
      <div class="mb-3 col-md-3">
        <label for="name">{{ __('table.expired_date') }}</label>
        <input type="date" class="form-control" placeholder="{{ __('table.expired_date') }}" name="expired_at"
          value="{{ $row->expired_at ?? old('expired_at') }}" />
        <div id="input-expired_at" style="color: red"></div>

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


  @endpush