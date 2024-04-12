@extends('backend.includes.table')
@section('table-name')
  المنتجات
@endsection
@section('table')
<table id="file_export" class="table border table-striped table-bordered display text-nowrap">
<thead>
  <!-- start row -->
  <tr>
    <th>#</th>
    <th>اسم المنتج</th>
    <th>القسم</th>
    <th>السعر</th>
    <th>الحالة</th>
    <th>الصورة</th>
    <th>التقييمات</th>
    <th>عدد المقيمين</th>
    <th>الكمية</th>
    <th>الماركة</th>
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
  <td>{{ $row->category->name ?? '' }}</td>
  <td>{{ $row->price }}</td>
  <td>{!! $row->status() !!}</td>
  <td>
    <div class="d-flex align-items-center">
      @foreach ($row->files as $file)
      <a href="#">
        <img src="{{ asset('images/products/'.$file->name) }}"
          class="rounded-circle me-n2 card-hover border border-2 border-white" width="39"
          height="39">
      </a>
      @endforeach
    
     
    </div>
  </td>
  <td>{{ $row->review_avg }}</td>
  <td>{{ $row->review_count }}</td>
  <td>{{ $row->quantity }}</td>
  <td>{{ $row->brand->name ?? '' }}</td>
  <td>@include('backend.includes.buttons')</td>
 </tr>
@endforeach

  <!-- end row -->
</tbody>
<tfoot>
  <!-- start row -->
  <tr>
    <th>#</th>
    <th>اسم المنتج</th>
    <th>القسم</th>
    <th>السعر</th>
    <th>الحالة</th>
    <th>الصورة</th>
    <th>التقييمات</th>
    <th>عدد المقيمين</th>
    <th>الكمية</th>
    <th>الماركة</th>
    <th>العمليات</th>
  </tr>
  <!-- end row -->
</tfoot>
</table>
@endsection