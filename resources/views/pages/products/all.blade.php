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

          <div class="card-header">
          <a class="btn btn-primary btn-round text-white pull-right" href="{{ route('product.create') }}" title="Add Product"><i class="now-ui-icons ui-1_simple-add"></i> Product</a>
            <h5 class="title">Product Management</h5>
          </div>

          <div class="card-body">
            @if(!empty($data) && $data->count())

              <div class="table-responsive">
                <table class="table table-hover text-center" >
                  <thead class=" text-primary">
                    <th>#</th>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Image</th>
                    <th class="header text-right">Action</th>
                  </thead>

                  <tbody>
                  <!-- @php($i = 1) -->
                  <?php $i = ($data->currentpage()-1)* $data->perpage(); ?>
                      @foreach($data as $product)
                          <tr>
                            <th scope="row" style="text-align: center;">{{ $i += 1 }}</th>
                            <td>{{ $product->product_id }}</td>
                            <td>{{ $product->product_name }}</td>
                            <td>
                              @if($product->img_path != NULL) 
                                <img class="card-img-top" src="{{ $product->img_path }}" style="max-width:80px">
                              @else
                                &nbsp;
                              @endif
                            </td>
                            <td class="text-right">
                              <form action="{{ route('product.destroy', $product->id)}}" method="post">
                                @csrf
                                <a type="button" href="{{ route('product.edit', $product->id)}}" class="btn btn-success btn-sm btn-icon" title="Edit">
                                  <i class="now-ui-icons ui-2_settings-90"></i>
                                </a>
                                <button type="submit" onclick="return confirm('Are you sure you want to delete this item?');" class="btn btn-danger btn-sm btn-icon" title="Delete">
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