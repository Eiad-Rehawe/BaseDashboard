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
        <span class="hide-menu">Dashboard</span>
      </a>
    </li>
    <li class="sidebar-item">
      <a class="sidebar-link" href="{{route('backend.users.index')}}" aria-expanded="false">
        <span>
          <i class="ti ti-users"></i>
        </span>
        <span class="hide-menu">Users</span>
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
      <img
        src="{{asset('assets/dashboard/images/profile/user-1.jpg')}}"
        class="rounded-circle"
        width="40"
        height="40"
        alt=""
      />
    </div>
    <div class="john-title">
      <h6 class="mb-0 fs-4 fw-semibold">Mathew</h6>
      <span class="fs-2">Designer</span>
    </div>
    <button
      class="border-0 bg-transparent text-primary ms-auto"
      tabindex="0"
      type="button"
      aria-label="logout"
      data-bs-toggle="tooltip"
      data-bs-placement="top"
      data-bs-title="logout"
    >
      <i class="ti ti-power fs-6"></i>
    </button>
  </div>
</div>

<!-- ---------------------------------- -->
<!-- Start Vertical Layout Sidebar -->
<!-- ---------------------------------- -->
