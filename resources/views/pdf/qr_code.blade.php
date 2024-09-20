{{-- <!DOCTYPE html>
<html>
<head>
    <title>Product Barcode</title>
</head>
<style>
    @page { margin: 10px; }
    body { margin: 10px; }
</style>
<body>
    <h1>Product Barcode</h1>

    @for ($i = 0; $i < $count; $i++)
        <div>
            <p>Barcode {{ $i + 1 }}</p>
            {!!  $barcode !!}
        </div>
        <br>
    @endfor
</body>
</html> --}}

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <style> 
        .code{
            height: 60px !important;
        }
    
    </style>
</head>
<body>
    <div class="container mt-4">
        <button id="button" class="btn btn-primary">{{ __('table.download_pdf') }}</button>

        <div class="card row" id="body">
          
            @for ($i = 0; $i < $count; $i++)
            <div class="card-body col-3" id="barcodeInput">
                {{-- {!! QrCode::size(100)->backgroundColor(255,90,0)->generate($url) !!} --}}
               {{-- {!! DNS1D::getBarcodeHTML("$row->id",'UPCA',2,50) !!} --}}
               {{-- {!!  DNS1D::getBarcodeHTML($url, "C128" ,2,50)!!} --}}
               {{-- <img src="data:image/png;base64,{{DNS1D::getBarcodePNG($barcode_id, 'C39',1,55,array(0,0,0), true)}}" alt="barcode" /> --}}
                {!! $barcodeHtml !!}
            </div>
            @endfor
           
        </div>
       
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

    <script>
        const btn = document.getElementById("button");
        
        btn.addEventListener("click", function(){
        var element = document.getElementById('body');
        html2pdf().from(element).save('filename.pdf');
        });
    </script>
   
</body>
</html>