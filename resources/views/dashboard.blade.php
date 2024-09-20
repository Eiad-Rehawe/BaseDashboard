@extends('layouts.app')
@section('content')

<div class="row">
  <!-- Weekly Stats -->
  <div class="col-lg-6 col-md-6 col-sm-6 col-12 d-flex align-items-strech">
    <div class="card w-100">
      <div class="card-body">
        {{-- <h5 class="card-title fw-semibold">Weekly Stats</h5>
        <p class="card-subtitle mb-0">Average sales</p>
        <div id="stats" class="my-4"></div> --}}
        <div class="position-relative">
          <div
            class="d-flex align-items-center justify-content-between mb-7"
          >
            <div class="d-flex">
              <div
                class="p-6 bg-primary-subtle rounded me-6 d-flex align-items-center justify-content-center"
              >
                <i class="ti ti-grid-dots text-primary fs-6"></i>
              </div>
              <div>
                <h6 class="mb-1 fs-4 fw-semibold">{{ __('table.sells') }}</h6>
                {{-- <p class="fs-3 mb-0">Johnathan Doe</p> --}}
              </div>
            </div>
            @if(!empty($sells ))
            <div class="bg-primary-subtle badge">
              <p class="fs-3 text-primary fw-semibold mb-0">{{ $sells }}</p>
            </div>
            @endif
        
          </div>
          <div
            class="d-flex align-items-center justify-content-between mb-7"
          >
            <div class="d-flex">
              <div
                class="p-6 bg-success-subtle rounded me-6 d-flex align-items-center justify-content-center"
              >
                <i class="ti ti-grid-dots text-success fs-6"></i>
              </div>
              <div>
                <h6 class="mb-1 fs-4 fw-semibold">{{ __('table.money_capital') }}</h6>
                {{-- <p class="fs-3 mb-0">MaterialPro Admin</p> --}}
              </div>
            </div>
            @if(!empty($money_capital ))
            <div class="bg-success-subtle badge">
              <p class="fs-3 text-success fw-semibold mb-0">{{ $money_capital  }}</p>
            </div>
            @endif
          </div>
          <div
            class="d-flex align-items-center justify-content-between"
          >
            <div class="d-flex">
              <div
                class="p-6 bg-danger-subtle rounded me-6 d-flex align-items-center justify-content-center"
              >
                <i class="ti ti-grid-dots text-danger fs-6"></i>
              </div>
              <div>
                <h6 class="mb-1 fs-4 fw-semibold">
                  {{ __('table.benefits') }}
                </h6>
              </div>
            </div>
            @if(!empty($benefits ))
            <div class="bg-danger-subtle badge">
              <p class="fs-3 text-danger fw-semibold mb-0">{{ $benefits }}</p>
            </div>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
 
    <div class="col-lg-6 col-md-6 col-sm-6 col-12 d-flex align-items-stretch">
      <div class="card w-100">
        <div class="card-body">
          <h5>Circle Radial Bar Chart</h5>
          <div id="chart-radial-circle"></div>
        </div>
      </div>
    </div>
    <!-- Start Gradient Radial Bar Chart -->
 
  <!-- Top Performers -->
 
</div>
@endsection
@push('scripts')
<script src="{{asset('assets/dashboard/libs/owl.carousel/dist/owl.carousel.min.js')}}"></script>
    <script src="{{asset('assets/dashboard/libs/apexcharts/dist/apexcharts.min.js')}}"></script>
    <script src="{{asset('assets/dashboard/js/dashboards/dashboard.js')}}"></script>
    <script>
      $(document).ready(function(){
        var lang = $(location).attr('pathname');

        lang.indexOf(1);

        lang.toLowerCase();

        lang = lang.split("/")[1];
      
       
        $.ajax({
                url: window.location.origin+`/admin/data`,
                type: "GET",
             
                dataType: "json",
                success:function(response){
                  console.log(response)
                  var options_custom_circle = {
        series: [response.today.length, response.this_week.length, response.this_month.length],
        chart: {
            fontFamily: '"Nunito Sans", sans-serif',
            height: 390,
            type: "radialBar",
        },
        plotOptions: {
            radialBar: {
                offsetY: 0,
                startAngle: 0,
                endAngle: 270,
                hollow: {
                    margin: 5,
                    size: "30%",
                    background: "transparent",
                    image: undefined,
                },
                dataLabels: {
                    name: {
                        show: false,
                    },
                    value: {
                        show: false,
                    },
                },
            },
        },
        colors: ["#615dff", "#3dd9eb", "#ffae1f", ],
        labels: ["today", "this week", "this month"],  
        legend: {
            show: true,
            floating: true,
            
            fontSize: "16px",
            position: "left",
            offsetX: 80,
            offsetY: 15,
            labels: {
                useSeriesColors: true,
            },
            markers: {
                size: 0,
            },
            formatter: function (seriesName, opts) {
                return seriesName + ":  " + opts.w.globals.series[opts.seriesIndex];
            },
            itemMargin: {
                vertical: 3,
            },
        },
        responsive: [{
            breakpoint: 480,
            options: {
                legend: {
                    show: false,
                },
            },
        },],
    };

    var chart_radial_custom_circle = new ApexCharts(
        document.querySelector("#chart-radial-circle"),
        options_custom_circle
    );
    chart_radial_custom_circle.render();
                }
      })
    })
  
    </script>
@endpush 


