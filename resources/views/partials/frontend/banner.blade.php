<div class="banner">
    <div class="container">
        <div class="row">
            @foreach ($posters as $poster)
            @if(count($posters) == 1)
            <div class="col-lg-12 col-md-12 col-sm-12">
                @else
                <div class="col-lg-6 col-md-6 col-sm-6">
            @endif
                <div class="banner__pic">
                    <img src="{{$poster->product != null ? $poster->product->files()->first()->file_url : $poster->category->files()->first()->category_url }}" alt="">
                </div>
            </div>
            @endforeach
         
        </div>
    </div>
</div>