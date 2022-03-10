@extends('layouts.app')

@section('content')
  <div class="panel-header panel-header-sm">
  </div>

  <div class="content">
    <div class="row">
      <div class="col-md-12">

        @if(session('success'))          
          <div class="alert alert-success">
            <button type="button" aria-hidden="true" class="close">
                <i class="now-ui-icons ui-1_simple-remove"></i>
            </button>
            <span><strong>Successful!</strong> {{ session('success') }}</span>
          </div>
        @endif

        <div class="card">

          <div class="card-header"><h5 class="title">User Management</h5></div>

          <div class="card-body">
            @if(!empty($data) && $data->count())

              <div class="table-responsive">
                <table class="table table-hover text-center" >
                  <thead class=" text-primary">
                    <th>#</th>
                    <th>Name</th>
                    <th>Phone No.</th>
                    <th>Email</th>
                    <th class="text-right">Action</th>
                  </thead>

                  <tbody>
                  <!-- @php($i = 1) -->
                  <?php $i = ($data->currentpage()-1)* $data->perpage(); ?>
                      @foreach($data as $user)
                          <tr>
                            <th scope="row" style="text-align: center;">{{ $i += 1 }}</th>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->phone }}</td>
                            <td>{{ $user->email }}</td>
                            <td class="text-right">
                              <a type="button" href="{{ route('user.view', $user->id)}}" class="btn btn-success btn-sm btn-icon" title="View Detail">
                                <i class="now-ui-icons media-1_button-play"></i>
                              </a>
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