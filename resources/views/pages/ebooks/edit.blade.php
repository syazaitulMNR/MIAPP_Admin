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
            <h5 class="title" style="text-transform: capitalize">Edit - {{ $book->ebook_name }}</h5>
          </div>

          <div class="card-body">
            <form method="post" action="{{ route('ebook.update', $book->id) }}" autocomplete="off" enctype="multipart/form-data" >
              @csrf
              @include('alerts.success')

              <div class="row">
                <div class="col-md-7 pr-1">

                  <div class="row">
                      <div class="col-md-12 pr-1">
                          <div class="form-group">
                              <label>{{__(" Name")}}<span class="text-danger">*</span></label>
                              <input type="text" name="ebook_name" class="form-control" style="text-transform: capitalize" placeholder="Insert EBook Name" value="{{ $book->ebook_name }}" required>
                              @include('alerts.feedback', ['field' => 'ebook_name'])
                          </div>
                      </div>
                  </div>

                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="exampleInputEmail1">{{__(" Description")}}</label>
                        <textarea rows="3" class="form-control" name="desc" placeholder="Insert EBook's Description" >{{ $book->desc}}</textarea>
                        @include('alerts.feedback', ['field' => 'desc'])
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">{{__(" EBook Cover")}}</label>
                        <input type="file" name="ebook_cover" class="form-control" placeholder="Insert EBook's Description">
                        @include('alerts.feedback', ['field' => 'ebook_cover'])
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">{{__(" PDF File")}}</label>
                        <input type="file" name="ebook_pdf" class="form-control" placeholder="Insert EBook's Description">
                        @include('alerts.feedback', ['field' => 'ebook_pdf'])
                      </div>
                    </div>
                  </div>

                  <div class="card-footer text-right">
                    <a href="{{ route('ebooks') }}" class="btn btn-danger btn-round">{{__('Cancel')}}</a>
                    <button type="submit" class="btn btn-success btn-round">{{__('Save')}}</button>
                  </div>

                </div>

                <div class="col-md-5 text-center">
                  <img class="card-img-top" src="{{ $book->ebook_cover }}" style="max-width:50%">
                </div>
              </div>           

              <hr class="half-rule"/>
            </form>
              
          </div>
        </div>
      </div>
    </div>
  </div>

<script>
    $(document).ready(function(){
        $('input[type="file"]').change(function(e){
            var fileName = e.target.files[0].name;
        });
    });
</script>
@endsection