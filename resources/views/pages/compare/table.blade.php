<tr>
    <td>{{ $product->price() }}</td>
    <td>
        @if(app()->getLocale() == 'ar')
        {!! $product->descrption_ar !!}
        @else
        {!! $product->descrption_en !!}
        @endif
    </td>
    <td>
        @if(app()->getLocale() == 'ar')
        {{ $product->wight }} 
        @else
        {{ $product->wight }} 
        @endif
        
    </td>
</tr>

