@extends('layouts.app')

@section('content')
  <div class="panel-header panel-header-sm">
  </div>
  <div class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card">

          <div class="card-header">
            <h5 class="title">Create New EBook</h5>
          </div>

          <div class="card-body">
            <form method="post" action="{{ route('ebook.save') }}" autocomplete="off" enctype="multipart/form-data" >
              @csrf
              @include('alerts.success')
              
              <div class="col-md-12">
                <div class="row">
                  <div class="col-md-12 pr-1">
                      <div class="form-group">
                          <label>{{__(" Name")}}</label>
                          <input type="text" name="ebook_name" class="form-control" placeholder="Insert EBook Name" required>
                          @include('alerts.feedback', ['field' => 'ebook_name'])
                      </div>
                    </div>
                  </div>

                <div class="row">
                  <div class="col-md-12 pr-1">
                    <div class="form-group">
                      <label>{{__(" Description")}}</label>
                      <textarea rows="2" class="form-control" name="desc" placeholder="Insert EBook's Description" ></textarea>
                      @include('alerts.feedback', ['field' => 'desc'])
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6 pr-1">
                    <div class="form-group">
                      <label>{{__(" EBook Cover")}}</label>
                      <input type="file" name="ebook_cover" class="form-control" placeholder="Insert EBook's Description" required>
                      @include('alerts.feedback', ['field' => 'ebook_cover'])
                    </div>
                  </div>
    
                  <div class="col-md-6 pr-1">
                    <div class="form-group">
                      <label for="exampleInputEmail1">{{__(" PDF File")}}</label>
                      <input type="file" name="ebook_pdf" class="form-control" placeholder="Insert EBook's Description" required>
                      @include('alerts.feedback', ['field' => 'ebook_pdf'])
                    </div>
                  </div>
                </div>

                <div class="card-footer">
                  <div class="col-md-12 text-right">
                    <a href="{{ route('ebooks') }}" class="btn btn-danger btn-round">{{__('Cancel')}}</a>
                  
                    <button type="submit" class="btn btn-success btn-round">{{__('Save')}}</button>
                  </div>
                </div>

              <hr class="half-rule"/>
              </div>
                
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