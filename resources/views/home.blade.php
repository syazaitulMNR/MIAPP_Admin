@extends('layouts.app')

@section('content')
  <div class="panel-header panel-header-lg">
    <canvas id="bigDashboardChart"></canvas>
  </div>
  <div class="content">

    <div class="row">
      <!-- User Number -->
      <div class="col-lg-3">
        <div class="card card-chart">
          <div class="card-header">
            <p class="card-title">Registered User</p>
            <div class="dropdown">
              <button type="button" class="btn btn-round btn-outline-default dropdown-toggle btn-simple btn-icon no-caret" data-toggle="dropdown">
                <i class="now-ui-icons loader_gear"></i>
              </button>
              <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="{{ route('users') }}">User List</a>
              </div>
            </div>
          </div>
          <div class="pb-3">
            <h4 class="card-text text-center">{{ $userNum }}</h4>
          </div>
        </div>
      </div>
      <!-- End User Number -->

      <!-- Event Number -->
      <div class="col-lg-3">
        <div class="card card-chart">
          <div class="card-header">
            <p class="card-title">Total Event (Active)</p>
            <div class="dropdown">
              <button type="button" class="btn btn-round btn-outline-default dropdown-toggle btn-simple btn-icon no-caret" data-toggle="dropdown">
                <i class="now-ui-icons loader_gear"></i>
              </button>
              <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="{{ route('programs') }}">Event List</a>
              </div>
            </div>
          </div>
          <div class="pb-3">
            <h4 class="card-text text-center">{{ $proNum }}</h4>
          </div>
        </div>
      </div>
      <!-- End Event Number -->

      <!-- Promo Number -->
      <div class="col-lg-3">
        <div class="card card-chart">
          <div class="card-header">
            <p class="card-title">Total Promo (Active)</p>
            <div class="dropdown">
              <button type="button" class="btn btn-round btn-outline-default dropdown-toggle btn-simple btn-icon no-caret" data-toggle="dropdown">
                <i class="now-ui-icons loader_gear"></i>
              </button>
              <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="{{ route('offers') }}">Promo List</a>
              </div>
            </div>
          </div>
          <div class="pb-3">
            <h4 class="card-text text-center">{{ $offerNum }}</h4>
          </div>
        </div>
      </div>
      <!-- End Promo Number -->

      <!-- EBook Number -->
      <div class="col-lg-3">
        <div class="card card-chart">
          <div class="card-header">
            <p class="card-title">Total EBook</p>
            <div class="dropdown">
              <button type="button" class="btn btn-round btn-outline-default dropdown-toggle btn-simple btn-icon no-caret" data-toggle="dropdown">
                <i class="now-ui-icons loader_gear"></i>
              </button>
              <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="{{ route('ebooks') }}">EBook List</a>
              </div>
            </div>
          </div>
          <div class="pb-3">
            <h4 class="card-text text-center">{{ $bookNum }}</h4>
          </div>
        </div>
      </div>
      <!-- End EBook Number -->

    </div>

    <div class="col-12">
      <a class="btn btn-round btn-outline-default btn-simple btn-icon no-caret pull-right" href="{{ route('offers') }}" >
        <i class="now-ui-icons loader_gear"></i>                                        
      </a>
      <h5 class="title">Overall Promotion</h5>
      <hr class="half-rule"/>

      <!-- @foreach($allOff as $all)
        @php
          $isAnswered = false;
        @endphp
          
        @foreach($byOffer as $by)
          @if ($all->id == $by->offer_id)
            @php
                $isAnswered = true;
            @endphp
          @elseif ($all->id != $by->offer_id)
            {{ $all->offer_name }} -> 0 <br>
            @php
                $isAnswered = false;
            @endphp
            @break
          @endif
        @endforeach
        
        @if ($isAnswered)
          {{ $all->offer_name }} -> {{ $by->total }}
        @endif
      @endforeach -->

      @foreach($allOff as $all)


        @foreach($byOffer as $claimed)
        @if ($all->id != $claimed->offer_id )

          {{ $all->offer_name }} -> 0 <br><br>
 
        @endif
        @endforeach
        @foreach($byOffer as $claimed)
          @if ($all->id == $claimed->offer_id)
            {{ $all->offer_name }} -> {{ $claimed->total }} <br>
    
          @endif
         
        @endforeach
      @endforeach
      

      <div class="row">
        @foreach($bygroup as $types)
          <!-- Promo Number -->
          <div class="col-lg-3">
            <div class="card card-chart">
              <div class="card-header">
                <p class="card-title text-center">{{ $types->type }}</p>
              </div>
              <div class="pb-3">
                <h4 class="card-title text-center">{{ $types->total }}</p>
              </div>
            </div>
          </div>
        <!-- End Promo Number -->
        @endforeach
      </div>
    </div>

    <div class="col-md-12">
      <!-- Show data in bar chart ----------------------------------------------->
      <div class="col-lg-4 col-md-6">
        <div class="card card-chart">
          <div class="card-header">
            <h4 class="card-title">24 Hours Performance</h4>
          </div>
          <div class="card-body">
            <div class="chart-area">
              <canvas id="barClaimed"></canvas>
            </div>
          </div>
          <div class="card-footer">
            <div class="stats">
              <i class="now-ui-icons ui-2_time-alarm"></i> Last 7 days
            </div>
          </div>
        </div>
      </div>
    </div>





    <div class="row">
      <div class="col-lg-4">
        <div class="card card-chart">
          <div class="card-header">
            <h5 class="card-category">Global Sales</h5>
            <h4 class="card-title">Shipped Products</h4>
            <div class="dropdown">
              <button type="button" class="btn btn-round btn-outline-default dropdown-toggle btn-simple btn-icon no-caret" data-toggle="dropdown">
                <i class="now-ui-icons loader_gear"></i>
              </button>
              <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="#">Action </a>
                <a class="dropdown-item" href="#">Another action</a>
                <a class="dropdown-item" href="#">Something else here</a>
                <a class="dropdown-item text-danger" href="#">Remove Data</a>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="chart-area">
              <canvas id="lineChartExample"></canvas>
            </div>
          </div>
          <div class="card-footer">
            <div class="stats">
              <i class="now-ui-icons arrows-1_refresh-69"></i> Just Updated
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6">
        <div class="card card-chart">
          <div class="card-header">
            <h5 class="card-category">2018 Sales</h5>
            <h4 class="card-title">All products</h4>
            <div class="dropdown">
              <button type="button" class="btn btn-round btn-outline-default dropdown-toggle btn-simple btn-icon no-caret" data-toggle="dropdown">
                <i class="now-ui-icons loader_gear"></i>
              </button>
              <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <a class="dropdown-item" href="#">Something else here</a>
                <a class="dropdown-item text-danger" href="#">Remove Data</a>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="chart-area">
              <canvas id="lineChartExampleWithNumbersAndGrid"></canvas>
            </div>
          </div>
          <div class="card-footer">
            <div class="stats">
              <i class="now-ui-icons arrows-1_refresh-69"></i> Just Updated
            </div>
          </div>
        </div>
      </div>
      <!-- <div class="col-lg-4 col-md-6">
        <div class="card card-chart">
          <div class="card-header">
            <h5 class="card-category">Email Statistics</h5>
            <h4 class="card-title">24 Hours Performance</h4>
          </div>
          <div class="card-body">
            <div class="chart-area">
              <canvas id="barChartSimpleGradientsNumbers"></canvas>
            </div>
          </div>
          <div class="card-footer">
            <div class="stats">
              <i class="now-ui-icons ui-2_time-alarm"></i> Last 7 days
            </div>
          </div>
        </div>
      </div> -->
    </div>
    

    
  </div>


  
<script>
  // Function to show bar chart
  var xValues = ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"];
  var yValues = ["{{ 2 }}", "{{ 2 }}", "{{ 2 }}", "{{ 2 }}", "{{ 2 }}", "{{ 2 }}", "{{ 2 }}" ];
    // @foreach($byOffer as $claimed)
    //   [ "{{ $claimed->total }}" ],
    // @endforeach
  // ];
  var barColors = ["#1B4F72", "#17A589", "#633974", "#F1948A", "#FDD74C", "#23B4B1", "#DA4414" ];

  new Chart("barClaimed", {
    type: "bar",
    data: {
      labels: xValues,
      datasets: [{
        backgroundColor: barColors,
        data: yValues
      }]
    },
    options: {
      legend: {display: false},
      title: {
        display: true,
        text: "Total Registration per Day (From 8am)"
      }
    }
  });
  // END Function to show bar chart

  //////////////////////////////////////////////////////////////////////////////////////////////////////
  
  /////////////////////////////////////////////////////////////////////////////////////////////////////

  // Function Bar Chart Claimed Offer
    var e = document.getElementById("barClaimed2");

      gradientFill = ctx.createLinearGradient(0, 170, 0, 50);
      gradientFill.addColorStop(0, "rgba(128, 182, 244, 0)");
      gradientFill.addColorStop(1, hexToRGB('#2CA8FF', 0.6));

      var a = {
          type: "bar",
          data: {
              labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
              datasets: [{
                  label: "Active Countries",
                  backgroundColor: gradientFill,
                  borderColor: "#2CA8FF", 
                  pointBorderColor: "#FFF",
                  pointBackgroundColor: "#2CA8FF",
                  pointBorderWidth: 2,
                  pointHoverRadius: 4,
                  pointHoverBorderWidth: 1,
                  pointRadius: 4,
                  fill: true,
                  borderWidth: 1,
                  data: [80, 99, 86, 96, 123, 85, 100, 75, 88, 90, 123, 155]
              }]
          },
          options: {
              maintainAspectRatio: false,
              legend: {
                  display: false
              },
              tooltips: {
                  bodySpacing: 4,
                  mode: "nearest",
                  intersect: 0,
                  position: "nearest",
                  xPadding: 10,
                  yPadding: 10,
                  caretPadding: 10
              },
              responsive: 1,
              scales: {
                  yAxes: [{
                      gridLines: 0,
                      gridLines: {
                          zeroLineColor: "transparent",
                          drawBorder: false
                      }
                  }],
                  xAxes: [{
                      display: 0,
                      gridLines: 0,
                      ticks: {
                          display: false
                      },
                      gridLines: {
                          zeroLineColor: "transparent",
                          drawTicks: false,
                          display: false,
                          drawBorder: false
                      }
                  }]
              },
              layout: {
                  padding: {
                      left: 0,
                      right: 0,
                      top: 15,
                      bottom: 15
                  }
              }
          }
      };
  // END Claimed


</script>
@endsection

@push('js')
  <script>
    $(document).ready(function() {
      // Javascript method's body can be found in assets/js/demos.js
      demo.initDashboardPageCharts();

    });
  </script>
@endpush