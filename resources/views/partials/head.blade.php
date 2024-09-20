<!-- Required meta tags -->
<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<!-- Favicon icon-->
<link
  rel="shortcut icon"
  type="image/png"
  href="{{ asset('assets/dashboard/images/logos/favicon.png') }}"
/>

<!-- Core Css -->
<link rel="stylesheet" href="{{ asset('assets/dashboard/css/styles.css') }}" />

<style>
  .dataTables_empty{
    text-align: center
  }
  .apexcharts-legend-series {
    cursor: pointer;
    line-height: normal;
    width: 100px;
}
.cart-icon-wrapper {
    position: relative;
    display: inline-block;
    cursor: pointer;
    background-color: #7fad39;
    border: #7fad39; 
    padding: 10px;
    color: #fff;
    border-radius: 25px;
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