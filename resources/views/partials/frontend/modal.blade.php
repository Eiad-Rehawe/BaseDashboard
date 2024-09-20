<div class="modal fade" id="check_coupon_code" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">{{ __('frontend.check_coupon_code') }}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('get_coupon') }}" method="post" id="apply_coupn">
                @method('post')
                @csrf
           
              <div class="form-group">
                <input type="text" id="cc" @if ($status == 'false') style="
                  display:none;
               "@endif class="from-control col-lg-12" name="cc" placeholder="{{ __('frontend.Enter your coupon code') }}"  value="{{ old('code') }}">

            </div>
              
                <button type="submit" class="btn btn-sm site-btn" style="margin: 10px;background:#7fad39">{{ __('frontend.send') }}</button>
            </form>
        </div>
       
      </div>
    </div>
  </div>