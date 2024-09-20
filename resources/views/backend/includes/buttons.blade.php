
<?php
$table;
if(request()->segment(3) == 'admins'){
    $table = 'موظف';
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


?>
  
  @if(request()->segment(3) != 'orders' && request()->segment(3) != 'customers'  && request()->segment(3) != 'contacts' && request()->segment(3) !='comments' )
  <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
    <div class="btn-group me-2 mb-2" role="group" aria-label="First group">
      @if(auth()->user()->can('Update '.ucfirst(rtrim(request()->segment(3), "s")))  || auth()->user()->can( 'تعديل ' .$table))

  <a class="btn btn-success d-flex align-items-center gap-3" href="{{ route('backend.' . request()->segment(3). '.edit', $row->id) }}" title="{{ __('table.Update') }}"><i
    class="fs-4 ti ti-edit"></i></a>
    @endif
    @if(auth()->user()->can('Delete '.ucfirst(rtrim(request()->segment(3), "s"))) || auth()->user()->can( 'حذف ' .$table))
    <a data-method="post" id="warning" data-id="{{ $row->id }}" class="btn btn-danger d-flex align-items-center gap-3" href="{{ route('backend.' .  request()->segment(3) . '.destroy', $row->id) }}" title="{{ __('table.Delete') }}"><i
        class="fs-4 ti ti-trash"></i></a> 
        @endif
        @if(auth()->user()->can('Update '.ucfirst(rtrim(request()->segment(3), "s")).'Status') || auth()->user()->can( 'تعديل حالة ال' .$table))

        @if(request()->segment(3) != 'roles')
        {!! $row->status() !!}
        @endif
        @endif
    </div>
   </div>
  @endif
 