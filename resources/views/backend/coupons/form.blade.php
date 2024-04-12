@extends('backend.includes.form')
@section('table-name')
الكوبونات
@endsection
@section('form')
@isset($row)
<form action="{{ route('backend.'.rules().'.update',$row->id) }}" method="post" enctype="multipart/form-data"
  class="submit-form">
  @csrf
  @method('put')
  @else
  <form action="{{ route('backend.'.rules().'.store') }}" method="post" enctype="multipart/form-data"
    class="submit-form">
    @csrf
    @method('post')
    @endisset


    <div class="row">
      <div class="mb-3 col-md-3">
        <label for="name">الكود</label>
        <input type="text" class="form-control" placeholder="Code" name="code"
          value="{{ $row->code ?? old('code') }}" />
        <div id="input-code" style="color: red"></div>

      </div>
      <div class="mb-3 col-md-3">
        <label for="name">القيمة</label>
        <input type="text" class="form-control" placeholder="Value" name="value"
          value="{{ $row->value ?? old('value') }}" />
        <div id="input-value" style="color: red"></div>

      </div>
      <div class="mb-3 col-md-3">
        <label for="user_id">الزبون</label>
        <select name="user_id[]"class="select2 form-control block" multiple="multiple">
          <option value="">select</option>
          <option value="0">الكل</option>
          @foreach ($users as $user)
          <option value="{{ $user->id }}" {{ isset($row) ? ($row->id == $user->id ? 'selected' :
            ''):(old('id')) }}>{{ $user->name }}</option>
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
        <label for="name">تاريخ الانتهاء</label>
        <input type="date" class="form-control" placeholder="Expired at" name="expired_at"
          value="{{ $row->expired_at ?? old('expired_at') }}" />
        <div id="input-expired_at" style="color: red"></div>

      </div>
      <div class="mb-3 col-md-12">
        <button class="
          btn
          rounded-pill
          px-4
          bg-success-subtle
          text-success
          font-weight-medium
          waves-effect waves-light
        " type="submit" style="float:left">
          <i class="ti ti-send fs-5"></i>
          Submit
        </button>

      </div>
    </div>
  </form>
  @endsection