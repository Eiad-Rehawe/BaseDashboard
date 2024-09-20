@extends('layouts.frontend')
@push('name')
{{ __('frontend.my_orders') }}
@endpush

@section('content')
<section class="hero hero-normal">
  <div class="container">
    <div class="row">
      @include('partials.frontend.hero-categories')
      <div class="col-lg-9">
        @include('partials.frontend.search')
      </div>
    </div>
  </div>
</section>


@include('partials.frontend.pages-herosection')
    <section class="py-3 py-md-5" style="direction: {{ app()->getLocale() == 'ar' ? 'rtl':'ltr' }};text-align:{{ app()->getLocale() == 'ar' ? 'right':'left' }}">
        <div class="container">
          <div class="row gy-3 gy-md-4 gy-lg-0 align-items-lg-center">
            <div class="table-responsive">
                <h2 style="margin: 10px">{{ __('frontend.my_orders') }}</h2>

                <table class="table table-striped 
                            table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>{{ __('frontend.order_number') }}</th>
                            <th>{{ __('frontend.order_status') }}</th>
                            <th>{{ __('frontend.total_cost') }}</th>
                            <th>{{ __('frontend.order_date') }}</th>
                            <th></th>
                         
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=0 ?>
                        @forelse ($orders as $order)
                        <?php $i++ ?>
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td> {!! $order->status_user() !!}</td>
                            <td>{{ $order->total() }}</td>
                            <td>{{ $order->order_date }}</td>
                            <td>
                             @if($order->status != 'Accept')
                            
                             <button type="button" class="site-btn" style="padding: 10px" data-toggle="modal" data-target="#exampleModal">
                                <span class="fas fa-edit"></span>
                              </button>
                             
                             <a  href="{{ route('deleteOrder',['order_id'=>$order->id]) }}" type="button" data-method="post" id="warning" data-id="{{ $order->id }}" style="padding: 10px" class="site-btn" href=" " title="{{ __('table.Delete') }}"><span
                                 class="fas fa-trash"></span></a> 
                                 <button type="button" class="site-btn"  data-id="{{ $order->id }}"  style="padding: 10px" id="exampleModalAddbutton">
                                    <span class="fas fa-plus"></span>
                                  </button>
                                  @endif
                                  <a href="{{ route('getDetails',['order_id'=>$order->id]) }}" type="button" class="site-btn view_order" data-id="{{ $order->id }}" style="padding: 10px"> <span class="fas fa-eye"></span></a>

                         
                            </td>
                            @include('pages.orders.edit-order',['order'=>$order])
                        </tr>

                        @empty
                            <tr><td colspan="5">{{ __('frontend.empty') }}</td></tr>
                        @endforelse
                      
                     
                    </tbody>
                </table>
            </div>
            <div class="table-responsive" id="exampleModalAdd" style="display: none">
              
                    <h2 style="margin: 10px">{{ __('frontend.add_product_to_order') }}</h2>

                    @include('pages.orders.add-product-to-order')
                </div>
   
            @if($first_order_details)
            <div class="table-responsive">
                <h2 style="margin: 10px">{{ __('frontend.order_details') }}</h2>
                <table class="table table-striped 
                            table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('frontend.order_number') }}</th>
                            <th>{{ __('frontend.product_name') }}</th>
                            <th>{{ __('frontend.price') }}</th>
                            <th>{{ __('frontend.quantity') }}</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="details">
                       <?php $i=0 ?>
                       @forelse($first_order_details as $first_order_detail)
                       <?php $i++ ?>
                       <tr>
                        <td>{{ $i }}</td>
                        <td>{{ $first_order_detail->order_id }} </td>
                        <td>{{ $first_order_detail->product_name }}</td>
                        <td>{{ $first_order_detail->price }}</td>
                        <td>{{ $first_order_detail->quantity }}</td>
                        <td>
                            @if($first_order_detail->order->status != 'Accept')
                              <a   type="button" data-method="post" id="warning" data-id="{{ $first_order_detail->id }}" style="padding: 10px" class="site-btn" href="{{ route('deleteProductOrder',['order_id'=>$first_order_detail->order_id,'product_id'=>$first_order_detail->product_id]) }}" title="{{ __('table.Delete') }}"><span
                            class="fas fa-trash"></span></a>
                            @endif
                         </td>
                    </tr>
                       @empty
                       <tr><td colspan="6">{{ __('frontend.empty') }}</td></tr>

                       @endforelse
                       
                      
                    </tbody>
                </table>
            </div>
           @endif
          </div>
        </div>

      </section>
@endsection
