  <aside class="left-sidebar with-vertical">
    <div>
      <!-- ---------------------------------- -->
      <!-- Start Vertical Layout Sidebar -->
      <!-- ---------------------------------- -->
      <div class="brand-logo d-flex align-items-center justify-content-between">
        <a href="{{ route('dashboard') }}" class="text-nowrap logo-img">
          <img src="{{ asset('assets/dashboard/images/logos/dark-logo.svg') }}" class="dark-logo" alt="Logo-Dark" />
          <img src="{{ asset('assets/dashboard/images/logos/light-logo.svg') }}" class="light-logo" alt="Logo-light" />
        </a>
        <a href="javascript:void(0)" class="sidebartoggler ms-auto text-decoration-none fs-5 d-block d-xl-none">
          <i class="ti ti-x"></i>
        </a>
      </div>


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
            <a class="sidebar-link" href="{{ route('backend.users.index') }}" aria-expanded="false">
              <span>
                <i class="ti ti-user"></i>
              </span>
              <span class="hide-menu">المستخدمين</span>
            </a>
          </li>
         
        </ul>
      </nav>

      <div
      class="fixed-profile p-3 mx-4 mb-2 bg-secondary-subtle rounded sidebar-ad mt-3"
      >
      <div class="hstack gap-3">
        <div class="john-img">
          <img
            src="{{ asset('assets/dashboard/images/profile/user-1.jpg')}}"
            class="rounded-circle"
            width="40"
            height="40"
            alt=""
          />
        </div>
        <div class="john-title">
          <h6 class="mb-0 fs-4 fw-semibold">{{auth()->user()->name}}</h6>
        </div>
        {{-- <button
          class="border-0 bg-transparent text-primary ms-auto"
          tabindex="0"
          type="button"
          aria-label="logout"
          data-bs-toggle="tooltip"
          data-bs-placement="top"
          data-bs-title="logout"
        >
          <i class="ti ti-power fs-6"></i>
        </button> --}}
        <form method="POST" action="{{ route('admin.logout') }}">
          @csrf
      
          {{-- <x-dropdown-link :href="route('logout')"
                  onclick="event.preventDefault();
                              this.closest('form').submit();">
              {{ __('Log Out') }}
          </x-dropdown-link> --}}
          <a href="{{route('admin.logout')}}"   tabindex="0"
          type="button"
          aria-label="logout"
          data-bs-toggle="tooltip"
          data-bs-placement="top"
          data-bs-title="logout" class="border-0 bg-transparent text-primary ms-auto"  onclick="event.preventDefault();
          this.closest('form').submit();"
        >    <i class="ti ti-power fs-6"></i>
        </a
      >
      </form>
      </div>
      </div>

      <!-- ---------------------------------- -->
      <!-- Start Vertical Layout Sidebar -->
      <!-- ---------------------------------- -->
    </div>
  </aside>