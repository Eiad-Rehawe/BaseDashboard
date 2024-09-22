<!-- ---------------------------------- -->
<!-- Start Vertical Layout Sidebar -->
<!-- ---------------------------------- -->
@include("partials.logo-sidebar")

<nav class="sidebar-nav scroll-sidebar" data-simplebar>
  <ul id="sidebarnav">
    <!-- ---------------------------------- -->
    <!-- Home -->
    <!-- ---------------------------------- -->
    <li class="nav-small-cap">
      <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
      <span class="hide-menu">Home</span>
    </li>
    <!-- ---------------------------------- -->
    <!-- Dashboard -->
    <!-- ---------------------------------- -->
    <li class="sidebar-item">
      <a class="sidebar-link" href="{{route('dashboard')}}" aria-expanded="false">
        <span>
          <i class="ti ti-aperture"></i>
        </span>
        <span class="hide-menu">{{ __('sidebar.dashboard') }}</span>
      </a>
    </li>
   
    @if(auth()->user()->can('Display Users') || auth()->user()->can('عرض المستخدمين'))
    <li class="sidebar-item">
      <a class="sidebar-link" href="{{route('backend.users.index')}}" aria-expanded="false">
        <span>
          <i class="ti ti-users"></i>
        </span>
        <span class="hide-menu">{{ __('sidebar.users') }}</span>
      </a>
    </li>
    @endif

    @if(auth()->user()->can('Display Roles') || auth()->user()->can('عرض الصلاحيات'))
    <li class="sidebar-item">
      <a class="sidebar-link" href="{{route('backend.roles.index')}}" aria-expanded="false">
        <span>
          <i class="ti ti-check"></i>
        </span>
        <span class="hide-menu">{{ __('sidebar.roles') }}</span>
      </a>
    </li>
    @endif
    @if(auth()->user()->can('Display Employees') || auth()->user()->can('عرض الموظفين'))
    <li class="sidebar-item">
      <a class="sidebar-link" href="{{route('backend.admins.index')}}" aria-expanded="false">
        <span>
          <i class="ti ti-users"></i>
        </span>
        <span class="hide-menu">{{ __('sidebar.admins') }}</span>
      </a>
    </li>
    @endif
    @if(auth()->user()->can('Display Category') || auth()->user()->can('عرض الأقسام'))
    <li class="sidebar-item">
      <a class="sidebar-link" href="{{route('backend.categories.index')}}" aria-expanded="false">
        <span>
          <i class="ti ti-menu"></i>
        </span>
        <span class="hide-menu">{{ __('sidebar.categories') }}</span>
      </a>
    </li>
    @endif
    @if(auth()->user()->can('Display Products') || auth()->user()->can('عرض المنتجات'))
    <li class="sidebar-item">
      <a class="sidebar-link" href="{{route('backend.products.index')}}" aria-expanded="false">
        <span>
          <i class="ti ti-brand-producthunt"></i>
        </span>
        <span class="hide-menu">{{ __('sidebar.products') }}</span>
      </a>
    </li>
    @endif
    @if(auth()->user('admin')->can('Display Offers') || auth()->user('admin')->can('عرض العروض'))
    <li class="sidebar-item">
      <a class="sidebar-link" href="{{route('backend.offers.index')}}" aria-expanded="false">
        <span>
          <i class="ti ti-notes"></i>
        </span>
        <span class="hide-menu">{{ __('sidebar.posters') }}</span>
      </a>
    </li>
    @endif
   
{{--  
  @if(auth()->user()->can('Display Complaiments') || auth()->user()->can('عرض الشكاوي'))
  <li class="sidebar-item">
    <a class="sidebar-link" href="{{route('backend.complaints.index')}}" aria-expanded="false">
      <span>
        <i class="ti ti-message"></i>
      </span>
      <span class="hide-menu">{{ __('sidebar.employee_complaiment') }}</span>
    </a>
  </li>
  @endif --}}
  {{-- @if(auth()->user()->can('Display Complaiments') || auth()->user()->can('عرض الشكاوي'))
  <li class="sidebar-item">
    <a class="sidebar-link" href="{{route('backend.complaiments')}}" aria-expanded="false">
      <span>
        <i class="ti ti-message"></i>
      </span>
      <span class="hide-menu">{{ __('sidebar.users_complaiment') }}</span>
    </a>
  </li>
  @endif --}}
  
  {{-- @if(auth()->user('admin')->can('Create Complaiment') || auth()->user('admin')->can('إضافة شكوى'))
    <li class="sidebar-item">
      <a class="sidebar-link" href="{{route('backend.complaints.create')}}" aria-expanded="false">
        <span>
          <i class="ti ti-message"></i>
        </span>
        <span class="hide-menu">{{ __('sidebar.complaints_create') }}</span>
      </a>
    </li>
    @endif --}}

    @if(auth()->user('admin')->can('Display Coupons') || auth()->user('admin')->can('عرض الكوبونات'))
    <li class="sidebar-item">
      <a class="sidebar-link" href="{{route('backend.coupons.index')}}" aria-expanded="false">
        <span>
          <i class="ti ti-discount"></i>
        </span>
        <span class="hide-menu">{{ __('sidebar.coupons') }}</span>
      </a>
    </li>
    @endif
    
    @if(auth()->user('admin')->can('Display Orders') || auth()->user('admin')->can('عرض الطلبات'))
    <li class="sidebar-item">
      <a class="sidebar-link" href="{{route('backend.orders.index')}}" aria-expanded="false">
        <span>
          <i class="ti ti-truck-delivery"></i>
        </span>
        <span class="hide-menu">{{ __('sidebar.orders') }}</span>
      </a>
    </li>
    @endif

    @if(auth()->user('admin')->can('Display Links') || auth()->user('admin')->can('عرض اللينكات'))
    <li class="sidebar-item">
      <a class="sidebar-link" href="{{route('backend.links.index')}}" aria-expanded="false">
        <span>
          <i class="ti ti-link"></i>
        </span>
        <span class="hide-menu">{{ __('sidebar.links') }}</span>
      </a>
    </li>
    @endif
    {{-- @if(auth()->user('admin')->can('Display Comments') || auth()->user('admin')->can('عرض التعليقات'))
    <li class="sidebar-item">
      <a class="sidebar-link" href="{{route('backend.comments.index')}}" aria-expanded="false">
        <span>
          <i class="ti ti-message"></i>
        </span>
        <span class="hide-menu">{{ __('sidebar.comments') }}</span>
      </a>
    </li>
    @endif --}}
 
    @if(auth()->user('admin')->can('Display Contacts') || auth()->user('admin')->can('عرض الرسائل'))
    <li class="sidebar-item">
      <a class="sidebar-link" href="{{route('backend.contacts.index')}}" aria-expanded="false">
        <span>
          <i class="ti ti-message"></i>
        </span>
        <span class="hide-menu">{{ __('sidebar.contacts') }}</span>
      </a>
    </li>
    @endif

    <li class="sidebar-item">
      <a class="sidebar-link" href="{{route('backend.abouts.index')}}" aria-expanded="false">
        <span>
          <i class="ti ti-message"></i>
        </span>
        <span class="hide-menu">{{ __('sidebar.abouts') }}</span>
      </a>
    </li>
   
    <!-- ---------------------------------- -->
    <!-- AUTH -->
    <!-- ---------------------------------- -->
    
 
  </ul>
</nav>

<div
  class="fixed-profile p-3 mx-4 mb-2 bg-secondary-subtle rounded sidebar-ad mt-3"
>
  <div class="hstack gap-3">
    <div class="john-img">
      <a href="{{ route('backend.admins.profile') }}">
      
        <img
        src="{{asset('assets/dashboard/images/profile/user-1.jpg')}}"
        class="rounded-circle"
        width="40"
        height="40"
        alt=""
      />
      </a>
     
    </div>
    <div class="john-title">
      <h6 class="mb-0 fs-4 fw-semibold">{{ auth()->user()->name }}</h6>
      <span class="fs-2">{{ auth()->user()->roles()->first()->name }}</span>
    </div>
    <form method="POST" action="{{ route('admin.logout') }}">
      @csrf

      {{-- <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();
      this.closest('form').submit();">
        {{ __('Log Out') }}
      </x-dropdown-link> --}}
      <a href="{{route('admin.logout')}}" class="btn btn-outline-primary"  class="border-0 bg-transparent text-primary ms-auto"
      tabindex="0"
      type="button"
      aria-label="logout"
      data-bs-toggle="tooltip"
      data-bs-placement="top"
      data-bs-title="logout" onclick="event.preventDefault();
this.closest('form').submit();"> <i class="ti ti-power fs-6"></i></a>
    </form>
  
  </div>
</div>

<!-- ---------------------------------- -->
<!-- Start Vertical Layout Sidebar -->
<!-- ---------------------------------- -->
