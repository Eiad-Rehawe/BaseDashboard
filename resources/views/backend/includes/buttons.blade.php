{{-- <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
    <div class="btn-group me-2 mb-2" role="group" aria-label="First group">
        <a href="{{ route('backend.' . rules() . '.edit', $row->id) }}" type="button" class="btn btn-outline-primary"
            title="تعديل"><i class="fa fa-edit"></i></a>
      <a href="{{ route('backend.' . rules() . '.destroy', $row->id) }}" type="button" class="btn btn-danger" data-method="post"
        title="حذف" id="warning" data-id="{{ $row->id }}"><i class="fa fa-trash"></i></a>
    </div>
   
  </div> --}}
  @if(request()->segment(2) != 'orders')
  <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
    <div class="btn-group me-2 mb-2" role="group" aria-label="First group">
  <a class="btn btn-success d-flex align-items-center gap-3" href="{{ route('backend.' . request()->segment(2). '.edit', $row->id) }}"><i
    class="fs-4 ti ti-edit"></i></a>
    <a data-method="post" id="warning" data-id="{{ $row->id }}" class="btn btn-danger d-flex align-items-center gap-3" href="{{ route('backend.' .  request()->segment(2) . '.destroy', $row->id) }}"><i
        class="fs-4 ti ti-trash"></i></a>
    </div>
   </div>
  @endif
 
  {{-- <div class="dropdown dropstart">
    <a href="#" class="text-muted" id="dropdownMenuButton" data-bs-toggle="dropdown"
      aria-expanded="false">
      <i class="ti ti-dots-vertical fs-6"></i>
    </a>
    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
     
      <li>
        <a class="dropdown-item d-flex align-items-center gap-3" href="{{ route('backend.' . rules() . '.edit', $row->id) }}"><i
            class="fs-4 ti ti-edit"></i>تعديل</a>
      </li>
      <li>
        <a data-method="post" id="warning" data-id="{{ $row->id }}" class="dropdown-item d-flex align-items-center gap-3" href="{{ route('backend.' . rules() . '.destroy', $row->id) }}"><i
            class="fs-4 ti ti-trash"></i>حذف</a>
      </li>
    </ul>
  </div> --}}