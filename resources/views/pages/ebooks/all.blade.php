@extends('layouts.app')

@section('content')
  <div class="panel-header panel-header-sm">
  </div>
  <div class="content">
    <div class="row">
      <div class="col-md-12">

        <div class="card">
          <div class="card-header">
            <a class="btn btn-primary btn-round text-white pull-right" href="{{ route('ebook.create') }}"><i class="now-ui-icons ui-1_simple-add"></i> Ebook</a>
            <h5 class="title">EBook Management</h5>
          </div>
        </div>

        <div class="row">
          @if(!empty($data) && $data->count())

            @foreach($data as $book)
              <div class="col-md-4">
                <div class="card text-center">
                  <img class="card-img-top" src="{{ asset($book->ebook_cover) }}" style="max-width:50%">
                  <div class="card-body">
                    <h6 class="title">{{ $book->ebook_name }}</h6>
                    <p class="card-text">{{ $book->desc }}</p>

                    <div class="row mx-auto">
                      <a type="button" target="blank" href="{{ $book->ebook_pdf}}" class="btn btn-warning btn-sm">
                          <i class="now-ui-icons education_paper"></i> PDF
                      </a>
                      <a type="button" rel="tooltip" href="{{ route('ebook.edit', $book->id)}}" class="btn btn-success btn-sm btn-icon">
                          <i class="now-ui-icons ui-2_settings-90"></i>
                      </a>
                      <form action="{{ route('ebook.destroy', $book->id)}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Are you sure you want to delete this item?');" class="btn btn-danger btn-sm btn-icon">
                          <i class="now-ui-icons ui-1_simple-remove"></i>
                        </button>
                      </form>
                    </div> 

                  </div>
                </div>
              </div>
            @endforeach

          @else
            <h7 class="text-center">There are no data.</h7>
          @endif
        </div>

        <div class="float-right pt-3">{{$data->links('pagination::bootstrap-4')}}</div>
        
      </div>
    </div>
  </div>
@endsection