@extends('backend.includes.table')
@section('table-name')
الكوبونات
@endsection
@section('table')
<table id="file_export" class="table border table-striped table-bordered display text-nowrap">
<thead>
  <!-- start row -->
  <tr>
    <th>#</th>
    <th>الكود</th>
    <th>القيمة</th>
    <th>الحالة</th>
    {{-- <th>الزبون</th> --}}
    <th>تاريخ الانتهاء</th>
    <th>العمليات</th>
    
  </tr>
  <!-- end row -->
</thead>
<tbody>
  <!-- start row -->
  <?php $i=0;?>
@foreach ($data as $row)
<?php $i++?>
<tr>
  <td>{{ $i }}</td>
  <td>{{ $row->code }}</td>
  <td>{{ $row->value}}</td>
  <td>{!! $row->status() !!}</td>
  {{-- <td>
   {{ $row->users->name ?? 'لا يوجد' }}
  </td> --}}
  <td>{{ $row->expired_at }}</td>
  <td>@include('backend.includes.buttons')</td>
 </tr>
@endforeach

  <!-- end row -->
</tbody>
<tfoot>
  <!-- start row -->
  <tr>
    <th>#</th>
    <th>الكود</th>
    <th>القيمة</th>
    <th>الحالة</th>
    {{-- <th>الزبون</th> --}}
    <th>تاريخ الانتهاء</th>
    <th>العمليات</th>
    
  </tr>
  <!-- end row -->
</tfoot>
</table>
@endsection