
<form action="{{ route('add_products_to_order') }}" class="submit-form-add-to-order" method="post">
    @csrf
    @method('post')
    <table class="table table-bordered">
      <thead>
        <tr>
          <th scope="col">{{ __('frontend.select') }}</th>
          <th scope="col">{{ __('frontend.product') }}</th>
          <th scope="col">{{ __('frontend.price') }}</th>
          <th scope="col">{{ __('frontend.quantity') }}</th>
        </tr>
      </thead>
      <tbody>
        <!-- Sample Product Rows -->
        @forelse($products as $key=>$product)
        <tr >
          <td><input type="checkbox" name="product_id[]" value="{{ $product->id }}">
            <div id="input-product_id" style="color: red"></div>
        
        </td>
          <td>
            @if(app()->getLocale() == 'ar')
            {{ $product->name_ar }}
            @else
            {{ $product->name_en }}
            @endif
          </td>
          <td>
            {!! $product->price() !!}
          </td>
          <td><input type="number" name="qty[]" value="1" min="1" max="{{ $product->quantity }}" class="form-control">
            <div id="input-qty" style="color: red"></div>
        </td>
        </tr>
       @empty
       <tr colspan="4">{{ __('frontend.empty') }}</tr>
       @endforelse
        <!-- Add more product rows as needed -->
      </tbody>
    </table>
    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('frontend.close') }}</button>
    <button type="submit" class="btn btn-primary" style="background-color: #7fad39;border:#7fad39">{{
        __('frontend.send') }}</button>
  </form>
