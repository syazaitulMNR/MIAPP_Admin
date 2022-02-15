@extends('layouts.app')

@section('content')
  <div class="panel-header panel-header-sm">
  </div>
  <div class="content">
    <div class="row">
      
      @if(session('success'))          
        <div class="alert alert-success">
          <button type="button" aria-hidden="true" class="close">
              <i class="now-ui-icons ui-1_simple-remove"></i>
          </button>
          <span><strong>Successful!</strong> {{ session('success') }}</span>
        </div>
      @endif

      <div class="col-md-12">
        <div class="card">

          <div class="card-header">
            <a class="btn btn-primary btn-round text-white pull-right" href="{{ route('offer.create') }}" onclick="return confirm('Any new information regarding Promotion, Please refer OnPay');">
              <i class="now-ui-icons ui-1_simple-add"></i> Promotion
            </a>
            <h5 class="title">Promotion Management</h5>
          </div>

          <div class="card-body">
            @if(!empty($data) && $data->count())

              <div class="table-responsive">
                <table class="table table-hover text-center" >
                  <thead class=" text-primary">
                    <th>#</th>
                    <th>Name</th>
                    <th>Valid Until</th>
                    <th>Onpay Link</th>
                    <th>Action</th>
                  </thead>

                  <tbody>
                  <!-- @php($i = 1) -->
                  <?php $i = ($data->currentpage()-1)* $data->perpage(); ?>
                      @foreach($data as $offer)
                          <tr>
                            <th scope="row" style="text-align: center;">{{ $i += 1 }}</th>
                            <td style="text-transform:capitalize">{{ $offer->offer_name }}</td>
                            <td>{{ date('d/m/Y', strtotime($offer->valid_until)) }}</td>
                            <td>
                              <a target="_blank" href="{{ $offer->onpay_link }}">{{ $offer->onpay_link }}</a>
                            </td> 
                            <td class="text-right">
                              <form action="{{ route('offer.destroy', $offer->id)}}" method="post">
                                @csrf
                                @if($offer->status == 'Active')
                                  <a class="btn btn-success btn-sm">{{ $offer->status }}</a>
                                @else
                                  <a class="btn btn-default btn-sm">{{ $offer->status }}</a>
                                @endif 
                                <a type="button" href="{{ route('offer.edit', $offer->id)}}" class="btn btn-success btn-sm btn-icon">
                                  <i class="now-ui-icons ui-2_settings-90"></i>
                                </a>
                                <button type="submit" onclick="return confirm('Are you sure you want to delete this item?');" class="btn btn-danger btn-sm btn-icon">
                                  <i class="now-ui-icons ui-1_simple-remove"></i>
                                </button>
                              </form>
                            </td>
                          </tr>
                      @endforeach
                  </tbody>
                </table>
              </div>
              
              <div class="float-right pt-3">{{$data->links('pagination::bootstrap-4')}}</div>
              
            @else
                <h7 class="text-center">There are no data.</h7>
            @endif

          </div>

        </div>
      </div>
    </div>
  </div>
@endsection