<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('env.APP_NAME') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    @if (app()->getLocale() == 'ar')
<link rel="stylesheet" href="{{ asset('assets/frontend/css/style-rtl.css') }}">
    @else
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/bootstrap.min.css') }}" type="text/css">
    @endif
   
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <link rel="stylesheet" href="{{ asset('assets/frontend/css/elegant-icons.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/nice-select.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/jquery-ui.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/owl.carousel.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/slicknav.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/style.css') }}" type="text/css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css"> --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/css/bootstrap-select.min.css" rel="stylesheet">


    {{-- <link rel="stylesheet" href="{{ asset('assets/frontend/css/rating.css') }}"> --}}
    <style>
        .cart-icon {
      position: fixed; /* To position the badge relative to the icon */
      font-size: 30px;
      padding: 10px;
      right: 13px;
      bottom: 0px;
    }
    
    .cart-badge {
      position: absolute; /* Position relative to the parent (cart-icon) */
      top: -10px; /* Adjust as needed */
      right: -10px; /* Adjust as needed */
      background: #7fad39; /* Badge color */
      color: white; /* Text color */
      border-radius: 50%; /* Circular shape */
      padding: 0 6px; /* Padding for the badge text */
      font-size: 12px; /* Badge text size */
      line-height: 18px; /* To center the text vertically */
    }
    .select2-container .select2-selection--single{
    height:34px !important;
}
.select2-container--default .select2-selection--single{
         border: 1px solid #ccc !important; 
     border-radius: 0px !important; 
}
.cart-icon-wrapper {
    position: relative;
    display: inline-block;
    cursor: pointer;
    background-color: #7fad39;
    border: #7fad39; 
    padding: 10px;
    color: #fff
}

.cart-icon-wrapper .fa-shopping-cart {
    font-size: 24px;
    color: #333;
}

.cart-icon-wrapper input[type="file"] {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    opacity: 0;
    cursor: pointer;
}

</style>
<style>
   
    /* تنسيق الزر والقائمة المنسدلة */
    .dropbtn {
        background-color: #fff;
        color: #000;
        font-weight: bold;
        padding: 16px;
        font-size: 16px;
        border: none;
        cursor: pointer;
    }
    
    .dropdown {
        position: relative;
        display: inline-block;
    }
    
    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f9f9f9;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
        z-index: 1;
    }
    
    .dropdown-content a {
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
    }
    
    /* .dropdown-content a:hover {background-color: #f1f1f1} */
    
     /* .dropdown:hover .dropdown-content {
        display: block;
    }  */
    
    /* تنسيق القوائم الفرعية */
    .dropdown-submenu {
        position: relative;
    }
    
    .dropdown-submenu .dropdown-content {
        top: 0;
        left: 100%;
        margin-left: 1px;
    }
    
    .dropdown-submenu:hover .dropdown-content {
        display: block;
    }
    .breadcrumb {
        background-color: none
    }
    </style>
</head>