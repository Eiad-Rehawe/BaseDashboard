@extends('backend.includes.table')
@section('table-name')
  التعليقات
@endsection
@section('table')
  <table id="file_export" class="table border table-striped table-bordered display text-nowrap">
<thead>
  <!-- start row -->
  <tr>
    <th>#</th>
    <th>المستخدم</th>
    <th> المنتج</th>
    <th>التعليق</th>
   
    
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
  <td>{{ $row->user->name }}</td>
  <td>{{ $row->product->name }}</td>
  <td>{{ $row->comment }}</td>
  
 </tr>
@endforeach

  <!-- end row -->
</tbody>
<tfoot>
  <!-- start row -->
  <tr>
    <th>#</th>
    <th>المستخدم</th>
    <th> المنتج</th>
    <th>التعليق</th>
  </tr>
  <!-- end row -->
</tfoot>
</table>
@endsection