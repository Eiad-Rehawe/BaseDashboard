<!DOCTYPE html>
<html lang="en" dir="rtl" data-bs-theme="light" data-color-theme="Blue_Theme">

<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Favicon icon-->
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/dashboard/images/logos/favicon.png')}}" />

    <!-- Core Css -->
    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/styles.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.min.css">
    <title>{{ env('APP_NAME') }}</title>
    <style>
        ul li {
            color: red
        }

        .iti {
            width: 100%;
        }
        .iti__flag-container {
            display: flex;
            align-items: center;
            direction: ltr
        }
        .iti__country-list li{
            color: #000
        }
        .iti__country-list{
            width: 350px;
            bottom: -190px;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/toggle.css') }}">
</head>

<body style="background:  #7fad39">
    <div class="container" style="background:  #7fad39">
        <nav class=" navbar-expand-lg p-0" style="{{ app()->getLocale() == 'ar' ? 'float: right':'float: left' }}">


            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-center" >
                <!-- ------------------------------- -->
                <!-- start language Dropdown -->
                <!-- ------------------------------- -->
                <li class="nav-item dropdown">
                    <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{ asset('assets/dashboard/images/svgs/icon-flag-en.svg') }}" alt="" width="20px"
                            height="20px" class="rounded-circle object-fit-cover round-20" />
                    </a>
                    <div class="dropdown-menu {{ app()->getLocale() == 'en' ? 'dropdown-menu-end':'dropdown-menu-start' }} dropdown-menu-animate-up" aria-labelledby="drop2">
                        <div class="message-body">
                            <a href="{{ LaravelLocalization::getLocalizedURL('en', null, [], true) }}"
                                class="d-flex align-items-center gap-2 py-3 px-4 dropdown-item">
                                <div class="position-relative">
                                    <img src="{{ asset('assets/dashboard/images/svgs/icon-flag-en.svg') }}" alt=""
                                        width="20px" height="20px"
                                        class="rounded-circle object-fit-cover round-20" />
                                </div>
                                <p class="mb-0 fs-3">English (UK)</p>
                            </a>

                            <a href="{{ LaravelLocalization::getLocalizedURL('ar', null, [], true) }}"
                                class="d-flex align-items-center gap-2 py-3 px-4 dropdown-item">
                                <div class="position-relative">
                                    <img src="{{ asset('assets/dashboard/images/svgs/icon-flag-sa.svg') }}" alt=""
                                        width="20px" height="20px"
                                        class="rounded-circle object-fit-cover round-20" />
                                </div>
                                <p class="mb-0 fs-3">عربي (Arabic)</p>
                            </a>
                        </div>
                    </div>
                </li>


                <!-- ------------------------------- -->
                <!-- end profile Dropdown -->
                <!-- ------------------------------- -->
            </ul>
        </nav>
    </div>
    <!-- Preloader -->
    <div class="preloader">
        <img src="{{ asset('assets/dashboard/images/logos/favicon.png')}}" alt="loader" class="lds-ripple img-fluid" />
    </div>
    <div id="main-wrapper" style="background: #7fad39">
        <div
            class="position-relative overflow-hidden radial-gradient min-vh-100 w-100 d-flex align-items-center justify-content-center">
            <div class="d-flex align-items-center justify-content-center w-100">
                <div class="row justify-content-center w-100">
                    <div class="col-md-8 col-lg-6 col-sm-6 col-12 ">
                        <div class="card mb-0">
                            <div class="card-body">
                                <a href="" class="text-nowrap logo-img text-center d-block mb-5 w-100">
                                    <img src="{{ asset('assets/dashboard/images/logos/dark-logo.svg')}}"
                                        class="dark-logo" alt="Logo-Dark" />
                                    <img src="{{ asset('assets/dashboard/images/logos/light-logo.svg')}}"
                                        class="light-logo" alt="Logo-light" />
                                </a>


                                {{ $slot }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="dark-transparent sidebartoggler"></div>
    <!-- Import Js Files -->

    <script src="{{ asset('assets/dashboard/libs/jquery/dist/jquery.min.js')}}"></script>
    <script src="{{ asset('assets/dashboard/js/app.min.js')}}"></script>
    <script src="{{ asset('assets/dashboard/js/app.rtl.init.js')}}"></script>
    <script src="{{ asset('assets/dashboard/libs/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ asset('assets/dashboard/libs/simplebar/dist/simplebar.min.js')}}"></script>

    <script src="{{ asset('assets/dashboard/js/sidebarmenu.js')}}"></script>
    <script src="{{ asset('assets/dashboard/js/theme.js')}}"></script>
    <script src="{{ asset('assets/frontend/custom/script.js') }}"></script>
<!-- Latest compiled and minified JavaScript -->
<!-- Include the JS for intl-tel-input -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
<!-- Initialize the intl-tel-input plugin -->
<script>
    $(document).ready(function() {
        var input = document.querySelector("#Phone");
        var iti = window.intlTelInput(input, {
            initialCountry: "auto",
            geoIpLookup: function(callback) {
                $.get('https://ipinfo.io', function() {}, "jsonp").always(function(resp) {
                    var countryCode = (resp && resp.country) ? resp.country : "us";
                    callback(countryCode);
                });
            },
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js" // just for formatting/placeholders etc
        });

        input.addEventListener("countrychange", function() {
            var dialCode = iti.getSelectedCountryData().dialCode;
            input.value = "+" + dialCode;
        });

        // Set initial value after the country code is determined
        iti.promise.then(function() {
            var dialCode = iti.getSelectedCountryData().dialCode;
            input.value = "+" + dialCode;
        });
    });
</script>

<script>
    $(document).ready(function() {
        var input = document.querySelector("#Phone_1");
        var iti = window.intlTelInput(input, {
            initialCountry: "auto",
            geoIpLookup: function(callback) {
                $.get('https://ipinfo.io', function() {}, "jsonp").always(function(resp) {
                    var countryCode = (resp && resp.country) ? resp.country : "us";
                    callback(countryCode);
                });
            },
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js" // just for formatting/placeholders etc
        });

        input.addEventListener("countrychange", function() {
            var dialCode = iti.getSelectedCountryData().dialCode;
            input.value = "+" + dialCode;
        });

        // Set initial value after the country code is determined
        iti.promise.then(function() {
            var dialCode = iti.getSelectedCountryData().dialCode;
            input.value = "+" + dialCode;
        });
    });
</script>

</body>

</html>