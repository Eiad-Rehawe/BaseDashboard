<?php $i=0 ?>
@forelse($details as $detail)
<?php $i++ ?>
<tr>
 <td>{{ $i }}</td>
 <td>{{ $detail->order_id }} </td>
 <td>{{ $detail->product_name }}</td>
 <td>{{ $detail->price }}</td>
 <td>{{ $detail->quantity }}</td>
 <td>
    @if($detail->order->status != 'Accept')
      <a  type="button" data-method="post" id="warning" data-id="{{ $detail->id }}" style="padding: 10px" class="site-btn" href="{{ route('deleteProductOrder',['order_id'=>$detail->order_id,'product_id'=>$detail->product_id]) }}" title="{{ __('table.Delete') }}"><span
    class="fas fa-trash"></span></a> 
    @endif
</td>
</tr>
@empty
<tr><td colspan="6">{{ __('frontend.empty') }}</td></tr>

@endforelse