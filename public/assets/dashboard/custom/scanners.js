


  document.getElementById('inputGroupFile').addEventListener('change', function(event) {
    const file = event.target.files[0];
    if (!file) {
        return;
    }

    const reader = new FileReader();
    reader.onload = function(e) {
        const img = new Image();
        img.src = e.target.result;

        img.onload = function() {
            const canvas = document.createElement('canvas');
            const context = canvas.getContext('2d');
            canvas.width = img.width;
            canvas.height = img.height;
            context.drawImage(img, 0, 0, img.width, img.height);

            const imageData = context.getImageData(0, 0, canvas.width, canvas.height);

            Quagga.decodeSingle({
                src: canvas.toDataURL(),
                numOfWorkers: 4, // Improve performance
                inputStream: {
                    size: 800
                },
                decoder: {
                    readers: ["code_128_reader", "ean_reader", "ean_8_reader", "code_39_reader", "code_39_vin_reader", "codabar_reader", "upc_reader", "upc_e_reader", "i2of5_reader"],
                    debug: {
                        drawBoundingBox: true,
                        showFrequency: true,
                        drawScanline: true,
                        showPattern: true
                    }
                },
                locate: true
            }, function(result) {
                if (result && result.codeResult) {
                    document.getElementById('result').innerText = "Barcode: " + result.codeResult.code;

                    const lang = window.location.pathname.split("/")[1].toLowerCase();
                    const url = `${window.location.origin}/${lang}/check-product?barcode=${result.codeResult.code}`;
                
                    fetch(url, {
                        method: 'GET',
                        headers: {
                            'Content-Type': 'application/json'
                        }
                    })
                    .then(response => response.json())
                    .then(response => {
                       
                        if (response ) {
                          
                            $('input[type="search"]').val(response.barcode_id).trigger('input'); // Set the value and trigger input event

                        } else {
                            alert('Product not found');
                        }
                    })
                    .catch(error => {
                      alert(error)
                        console.error('Error:', error);
                        alert('Error retrieving product information.');
                    });
                } else {
                    document.getElementById('result').innerText = "No barcode detected";
                }
            });
        }
    };

    reader.readAsDataURL(file);
});

