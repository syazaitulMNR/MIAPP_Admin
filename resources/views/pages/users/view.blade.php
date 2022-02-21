@extends('layouts.app')

@section('content')
  <div class="panel-header panel-header-sm">
  </div>
  <div class="content">
    <div class="row">
      <div class="col-md-12">
        <!-------------------------------------------- Profile ------------------------------------------->
        <div class="card">

          <div class="card-header">
            <h5 class="title" style="text-transform: capitalize;">{{ $user->username }} </h5>
          </div>

          <div class="card-body">
            <div class="col-md-12">

              <div class="row">
                <div class="col-md-6 pr-1">
                    <div class="form-group">
                      <label>{{__(" Full Name")}}</label>
                      <input type="text" name="name" class="form-control" style="text-transform: capitalize; background-color: white; color:black;" value="{{ $user->name }}" readonly>
                      
                    </div>
                </div>

                <div class="col-md-6 pr-1">
                  <div class="form-group">
                    <label>{{__(" Phone Number")}}</label>
                    <input type="text" name="phone" class="form-control" style="background-color: white; color:black;" value="{{ $user->phone }}" readonly>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6 pr-1">
                    <div class="form-group">
                      <label>{{__(" Email")}}</label>
                      <input type="text" name="email" class="form-control" style="background-color: white; color:black;" value="{{ $user->email }}" readonly>
                    </div>
                </div>

                <div class="col-md-6 pr-1">
                  <div class="form-group">
                    <label>{{__(" Role")}}</label>
                    <input type="text" name="role" class="form-control" style="background-color: white; color:black;" value="{{ $user->role }}" readonly>
                  </div>
                </div>
              </div>

              <hr class="half-rule"/>

            </div>
          </div>

        </div>
        <!-------------------------------------------- End Profile ------------------------------------------->

        <!------------------------------------------- Claimed Offer ------------------------------------------>
        <div class="card">

          <div class="card-header">
            <h5 class="title">Claimed Promo</h5>
          </div>

          <div class="card-body">
            @if(!empty($userOffer) && $userOffer->count())

              <div class="table-responsive">
                <table class="table table-hover text-center" >
                  <thead class=" text-primary">
                    <th>#</th>
                    <th>Promo Name</th>
                    <th>Date Claimed</th>
                    <th class="text-right">Action</th>
                  </thead>

                  <tbody>
                    @foreach($userOffer as $offer)
                      @foreach($offers as $offername)
                        @if ($offername->id == $offer->offer_id)
                          <tr>
                            <th scope="row" style="text-align: center;">{{ $i += 1 }}</th>
                            <td style="text-transform:capitalize">{{ $offername->offer_name }}</td>
                            <td>{{ date('d/m/Y', strtotime($offer->created_at)) }}</td>
                            <td class="text-right">
                              @if($offername->status == 'Active')
                                <a class="btn btn-success btn-sm">{{ $offername->status }}</a>
                              @else
                                <a class="btn btn-default btn-sm">{{ $offername->status }}</a>
                              @endif 
                              <a type="button" href="{{ route('offer.edit', $offer->offer_id)}}" class="btn btn-success btn-sm btn-icon" title="Promotion Detail">
                                <i class="now-ui-icons media-1_button-play"></i>
                              </a>
                            </td>
                          </tr>
                        @endif
                      @endforeach
                    @endforeach
                  </tbody>
                </table>
              </div>
              
            @else
                <h7 class="text-center">There are no data.</h7>
            @endif

          </div>

        </div>
      </div>
    </div>
  </div>

@endsection