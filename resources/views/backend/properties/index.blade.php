@extends('backend.includes.table')
@section('table-name')
مواصفات المنتج
@endsection
@section('table')
<table id="file_export" class="table border table-striped table-bordered display text-nowrap">
<thead>
  <!-- start row -->
  <tr>
    <th>#</th>
    <th>الصفة</th>
    <th> القيمة</th>
    <th>الحالة</th>
    <th>المنتج</th>
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
  <td>{{ $row->name }}</td>
  <td>{{ $row->value}}</td>
  <td>{!! $row->status() !!}</td>
  <td>
{{ $row->product->name ?? '' }}
  </td>
  <td>@include('backend.includes.buttons')</td>
 </tr>
@endforeach

  <!-- end row -->
</tbody>
<tfoot>
  <!-- start row -->
  <tr>
    <th>#</th>
    <th>القسم</th>
    <th>القسم الاب</th>
    <th>الحالة</th>
    <th>الصورة</th>
    <th>العمليات</th>
  </tr>
  <!-- end row -->
</tfoot>
</table>
@endsection