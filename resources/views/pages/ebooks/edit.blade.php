@extends('layouts.app')

@section('content')
  <div class="panel-header panel-header-sm">
  </div>
  <div class="content">
    <div class="row">
      <div class="col-md-12">
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
            <label>{{__(" Name")}}</label>
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
      <button class="btn btn-primary btn-round"><i class="now-ui-icons arrows-1_cloud-upload-94"></i> {{__('Upload')}}</button>
      <input type="file" name="ebook_cover" class="file-control" placeholder="Insert EBook's Description">
      @include('alerts.feedback', ['field' => 'ebook_cover'])
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label for="exampleInputEmail1">{{__(" PDF File")}}</label>
      <button class="btn btn-primary btn-round"><i class="now-ui-icons arrows-1_cloud-upload-94"></i> {{__('Upload')}}</button>
      <input type="file" name="ebook_pdf" class="form-control" placeholder="Insert EBook's Description">
      @include('alerts.feedback', ['field' => 'ebook_pdf'])
    </div>
  </div>
</div>

<div class="card-footer">
  <a href="{{ route('ebook') }}" class="btn btn-danger btn-round">{{__('Back')}}</a>
  <button type="submit" class="btn btn-primary btn-round">{{__('Save')}}</button>
</div>

</div>

<div class="col-md-5">
<img class="card-img-top" src="{{ asset($book->ebook_cover) }}" style="max-width:50%">
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