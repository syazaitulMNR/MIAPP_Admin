@extends('layouts.app')

@section('content')
  <div class="panel-header panel-header-sm">
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
      <div class="card card-chart">
        <div class="card-header">
          <h4 class="card-title">Total Promotion Claimed by User {{$date->year}}</h4>
        </div>
        <div class="card-body">
          <div class="chart-area">
            <canvas id="bigDashboardChart"></canvas>
          </div>
        </div>
        <div class="card-footer">
        <div class="stats align-right">
            <i class="now-ui-icons arrows-1_refresh-69"></i> Just Updated
          </div>
        </div>
      </div>
    </div>
    

    
  </div> 
<script>
  var xValues =  @json($labelist);
  var yValues =  @json($number);
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