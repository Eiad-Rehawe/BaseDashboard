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

    <title>Login</title>
</head>

<body>
    <!-- Preloader -->
    <div class="preloader">
        <img src="{{ asset('assets/dashboard/images/logos/favicon.png')}}" alt="loader" class="lds-ripple img-fluid" />
    </div>
    <div id="main-wrapper">
        <div
            class="position-relative overflow-hidden radial-gradient min-vh-100 w-100 d-flex align-items-center justify-content-center">
            <div class="d-flex align-items-center justify-content-center w-100">
                <div class="row justify-content-center w-100">
                    <div class="col-md-8 col-lg-6 col-xxl-3">
                        <div class="card mb-0">
                            <div class="card-body">
                                <a href="" class="text-nowrap logo-img text-center d-block mb-5 w-100">
                                    <img src="{{ asset('assets/dashboard/images/logos/dark-logo.svg')}}" class="dark-logo" alt="Logo-Dark" />
                                    <img src="{{ asset('assets/dashboard/images/logos/light-logo.svg')}}" class="light-logo"
                                        alt="Logo-light" />
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

</body>

</html>