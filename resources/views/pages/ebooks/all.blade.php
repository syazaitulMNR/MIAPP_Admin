@extends('layouts.app')

@section('content')
  <div class="panel-header panel-header-sm">
  </div>
  <div class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card">

          <div class="card-header">
          <a class="btn btn-primary btn-round text-white pull-right" href=""><i class="now-ui-icons ui-1_simple-add"></i> Ebook</a>
            <h5 class="title">EBook Management</h5>
          </div>

          <div class="card-body">
            
              <!-- table -->
              <div class="table-responsive">
                <table class="table table-hover">

                  <thead class="text">
                    <th>#</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Cover Image</th>
                    <th class="text-right">Actions</th>
                  </thead>

                  <tbody>
                    <?php $i = ($data->currentpage()-1)* $data->perpage(); ?>
                    @foreach($data as $book)
                      <tr>
                        <td>{{ $i += 1 }}</td>
                        <td>{{ $data->ebook_name }}</td>
                        <td>{{ $data->desc }}</td>
                        <td>{{ $data->ebook_cover }}</td>
                        <td class="text-right">
                          <i class="now-ui-icons ui-1_settings-gear-63"></i>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>

                </table>
              </div>

              <div class="float-right pt-3">{{$data->links('pagination::bootstrap-4')}}</div>
          

          </div>
        </div>
      </div>
    </div>
  </div>
@endsection