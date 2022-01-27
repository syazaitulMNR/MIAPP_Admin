@extends('layouts.app')

@section('content')
  <div class="panel-header panel-header-sm">
  </div>
  <div class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card">

          <div class="card-header">
          <a class="btn btn-primary btn-round text-white pull-right" href="{{ route('product.create') }}"><i class="now-ui-icons ui-1_simple-add"></i> Product</a>
            <h5 class="title">Program Management</h5>
          </div>

          <div class="card-body">
            @if(!empty($data) && $data->count())

              <div class="table-responsive">
                <table class="table table-hover text-center" >
                  <thead class=" text-primary">
                    <th>#</th>
                    <th>Name</th>
                    <th>Page Link</th>
                    <th>Date</th>
                    <th class="text-right">Action</th>
                  </thead>

                  <tbody>
                  <!-- @php($i = 1) -->
                  <?php $i = ($data->currentpage()-1)* $data->perpage(); ?>
                      @foreach($data as $product)
                          <tr>
                            <th scope="row" style="text-align: center;">{{ $i += 1 }}</th>
                            <td style="text-transform:capitalize"></td>
                            <td>
                              <a target="_blank" href=""></a>
                            </td>
                            <td></td>
                            <td class="td-actions ">
                              <div class="row text-right">
                              <a type="button" href="{{ route('product.edit', $product->product_id)}}" class="btn btn-success btn-sm btn-icon">
                                <i class="now-ui-icons ui-2_settings-90"></i>
                              </a>&nbsp;
                              <form action="{{ route('product.destroy', $product->product_id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Are you sure you want to delete this item?');" class="btn btn-danger btn-sm btn-icon">
                                  <i class="now-ui-icons ui-1_simple-remove"></i>
                                </button>
                              </form>
                              </div>
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