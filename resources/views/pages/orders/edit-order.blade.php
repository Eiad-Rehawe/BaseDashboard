<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true"
    style="direction:{{ app()->getLocale() == 'ar' ? 'rtl':'ltr' }};text-align:{{ app()->getLocale() == 'ar' ? 'right':'left' }};">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('frontend.edit_order') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('updateOrder',['id'=>$order->id]) }}" class="submit-form" method="post">
                    @method('put')
                    @csrf
                    <div class="form-group">
                        <label for="exampleFormControlInput1">{{ __('frontend.Address') }}</label>
                        <input type="text" name="address_1" class="form-control" id="exampleFormControlInput1"
                            value="{{ $order->address_1 }}">
                        <div id="input-address_1" style="color: red"></div>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">{{ __('frontend.Phone') }}</label>
                        <input type="text" name="phone" class="form-control" id="exampleFormControlInput1"
                            value="{{ $order->phone }}">
                        <div id="input-phone" style="color: red"></div>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">{{ __('frontend.Email') }}</label>
                        <input type="email" name="email" class="form-control" id="exampleFormControlInput1"
                            value="{{ $order->email }}">
                        <div id="input-email" style="color: red"></div>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">{{ __('frontend.Order notes') }}</label>
                        <input type="text" name="notes" class="form-control" id="exampleFormControlInput1"
                            value="{{ $order->notes }}">
                        <div id="input-notes" style="color: red"></div>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputState">{{ __('frontend.selected_products') }}</label>
                        <select class="form-control" id="select_qty">
                            {{-- <option selected>{{ __('frontend.select') }}...</option> --}}
                            @foreach ($order->details as $d)
                            <option value="{{ $d->id }}">{{ $d->product_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <input type="hidden" name="product_id" value="{{ $order->details()->first()->product_id }}"
                        id="product_order">
                    <div class="form-group col-md-4">
                        <label for="exampleFormControlInput1">{{ __('frontend.quantity') }}</label>
                        <input name="qty" type="number" name="quantity_selected" min="1" max="@foreach ($order->details as $d)
                            {{ $d->product->quantity }}
                        @endforeach" class="form-control" id="qty_product_order"
                            value="{{ $order->details->first()->quantity }}">
                        <div id="input-qty" style="color: red"></div>
                    </div>
                    
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('frontend.close') }}</button>
                <button type="submit" class="btn btn-primary" style="background-color: #7fad39;border:#7fad39">{{
                    __('frontend.send') }}</button>
            </div>
            </form>

        </div>
    </div>
</div>

