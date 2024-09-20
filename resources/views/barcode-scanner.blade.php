<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuaggaJS Barcode Scanner</title>
    <style>
        #video {
            width: 100%;
            height: 400px;
        }
    </style>
</head>
<body>
    <div id="video"></div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/quagga/0.12.1/quagga.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let lastDetectedCode = null;
            let debounceTimeout = null;

            function onDetected(result) {
                const code = result.codeResult.code;

                if (lastDetectedCode !== code) {
                    lastDetectedCode = code;
                    clearTimeout(debounceTimeout);
                    debounceTimeout = setTimeout(() => {
                        lastDetectedCode = null;
                    }, 1000);

                    console.log('Barcode detected:', code);
                    alert('Barcode detected: ' + code);
                }
            }

            Quagga.init({
                inputStream: {
                    name: "Live",
                    type: "LiveStream",
                    target: document.getElementById('video'), // Or '#video' (optional)
                    constraints: {
                        facingMode: "environment", // Use the rear camera
                        width: { min: 640 },
                        height: { min: 480 },
                        aspectRatio: { min: 1, max: 100 },
                        focusMode: "continuous" // Try to keep focus
                    }
                },
                decoder: {
                    readers: [
                        "code_128_reader",
                        "ean_reader",
                        "ean_8_reader",
                        "upc_reader",
                        "upc_e_reader",
                        "code_39_reader",
                        "code_39_vin_reader",
                        "codabar_reader",
                        "i2of5_reader",
                        "2of5_reader",
                        "code_93_reader"
                    ]
                },
                locate: true, // Try to locate the barcode in the image
                numOfWorkers: navigator.hardwareConcurrency || 4, // Use multiple workers for better performance
                frequency: 10 // Increase the scanning frequency
            }, function(err) {
                if (err) {
                    console.error('Error initializing Quagga:', err);
                    return;
                }
                console.log('Quagga initialized successfully');
                Quagga.start();
            });

            Quagga.onDetected(onDetected);
        });
    </script>
</body>
</html>