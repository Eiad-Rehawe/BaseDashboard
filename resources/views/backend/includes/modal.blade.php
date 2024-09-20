<div class="modal fade" id="change_password_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">{{ __('sidebar.change_my_info') }}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{ route('backend.admins.update_admin_password') }}" method="post" class="submit-form">
            @csrf
            @method('put')
            <div class="mb-3">
                <label for="name"> {{ __('table.email') }}</label>
                <input type="email" class="form-control "
                    placeholder="{{ __('table.email') }}" name="email"
                    value="" />
                <div id="input-email" style="color: red"></div>

            </div>
            <div class="mb-3">
              <label for="name"> {{ __('table.address') }}</label>
              <input type="text" class="form-control "
                  placeholder="{{ __('table.address') }}" name="address"
                  value="" />
              <div id="input-address" style="color: red"></div>

          </div>
          <div class="mb-3">
            <label for="name"> {{ __('table.phone') }}</label>
            <input type="text" class="form-control "
                placeholder="{{ __('table.phone') }}" name="phone"
                value="" />
            <div id="input-phone" style="color: red"></div>

        </div>
            <div class="modal-footer">
        
                <button type="submit" class="btn btn-primary">{{ __('table.Submit') }}</button>
              </div>

        </form>
        </div>
       
      </div>
    </div>
  </div>