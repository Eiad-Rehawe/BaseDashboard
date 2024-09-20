<div class="profile-dropdown position-relative" data-simplebar>
  <div class="py-3 px-7 pb-0">
    <h5 class="mb-0 fs-5 fw-semibold">{{ __('sidebar.My Profile') }}</h5>
  </div>
  <div class="d-flex align-items-center py-9 mx-7 border-bottom">
    <img
      src="{{asset('assets/dashboard/images/profile/user-1.jpg')}}"
      class="rounded-circle"
      width="80"
      height="80"
      alt=""
    />
    <div class="ms-3">
      <h5 class="mb-1 fs-3">{{ auth()->user()->name }} </h5>
      <span class="mb-1 d-block">{{ auth()->user()->roles()->first()->name }}</span>
      <p class="mb-0 d-flex align-items-center gap-2">
        <i class="ti ti-mail fs-4"></i> {{ auth()->user()->email }}
      </p>
    </div>
  </div>
  <div class="message-body">
    <a
      href=""
      class="py-8 px-7 mt-8 d-flex align-items-center"
    >
      {{-- <span
        class="d-flex align-items-center justify-content-center text-bg-light rounded-1 p-6"
      >
        <img
          src="{{asset('assets/dashboard/images/svgs/icon-account.svg')}}"
          alt=""
          width="24"
          height="24"
        />
      </span> --}}
      
    </a>


  </div>
  <div class="row justify-content-center">
    <div class="col-lg-4 col-md-4 col-sm-4" >
      <form action="{{ route('backend.admins.profile') }}" method="get">

        <button type="submit" class="btn btn-outline-success">{{ __('sidebar.My Profile') }}</button>
      </form>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-4">
  
      <form method="POST" action="{{ route('admin.logout') }}">
        @csrf
  
        {{-- <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();
        this.closest('form').submit();">
          {{ __('Log Out') }}
        </x-dropdown-link> --}}
        <a href="{{route('admin.logout')}}" class="btn btn-outline-primary" onclick="event.preventDefault();
  this.closest('form').submit();">Log Out</a>
      </form>
    </div>
  </div>
 
</div>
