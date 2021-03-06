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
                              <input type="text" name="ebook_name" class="form-control" placeholder="Insert EBook Name" value="{{ $book->ebook_name }}" required>
                              @include('alerts.feedback', ['field' => 'ebook_name'])
                          </div>
                      </div>
                  </div>

                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="exampleInputEmail1">{{__(" Description (Optional)")}}</label>
                        <textarea rows="5" class="form-control" name="desc" placeholder="Insert EBook's Description" >{{ $book->desc}}</textarea>
                        @include('alerts.feedback', ['field' => 'desc'])
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="exampleInputEmail1">{{__(" PDF File")}}<span class="text-danger">*</span></label> <small class="text-danger">(max size: 10 mb)</small>
                        <input type="file" name="ebook_pdf" class="form-control" placeholder="Insert EBook's Description">
                        @include('alerts.feedback', ['field' => 'ebook_pdf'])
                      </div>
                    </div>
                  </div>

                </div>

                <div class="col-md-5 text-center">
                  <img class="card-img-top" src="{{ $book->ebook_cover }}" style="max-width:50%">
                </div>

              </div>

              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="exampleInputEmail1">{{__(" EBook Cover")}}<span class="text-danger">*</span></label>
                    <input type="file" name="ebook_cover" class="form-control" id="input" accept="image/*" placeholder="Insert EBook's Cover">
                    @include('alerts.feedback', ['field' => 'ebook_cover'])
                  </div>
                </div>
                <div class="col-md-6">
                  <br>
                  <div class="container" style="max-height: 540px;overflow:auto; position:absolute; top: 0; left:0; right:0; bottom:0">
                    <img id="image" src="" class="w-100">
                  </div>
                  <br>
                </div>
                <div class="col-md-2 text-center" style="align-self: center;">
                  <button type="button" class="btn btn-primary" id="crop">Crop</button>
                </div>
                <div class="col-md-4 text-center" style="align-self: center;">
                  <img class="rounded" id="avatar" src="{{URL::to('/assets/img/no_ebook.png')}}" alt="avatar">
                </div>
              </div><br>

              <div class="card-footer text-right">
                <a href="{{ route('ebooks') }}" class="btn btn-danger btn-round">{{__('Cancel')}}</a>
                <button type="submit" class="btn btn-success btn-round">{{__('Save')}}</button>
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

@push('js')
<script>
  window.addEventListener('DOMContentLoaded', function () {
    var avatar = document.getElementById('avatar');
    var image = document.getElementById('image');
    var input = document.getElementById('input');
    var cropper;

    input.addEventListener('change', function (e) {
      if(cropper){
        cropper.destroy();
        cropper = null;
      }

      var files = e.target.files;
      var done = function (url) {
        input.value = '';
        image.src = url;
      };
      var reader;
      var file;
      var url;

      if (files && files.length > 0) {
        file = files[0];

        if (URL) {
          done(URL.createObjectURL(file));
        } else if (FileReader) {
          reader = new FileReader();
          reader.onload = function (e) {
            done(reader.result);
          };
          reader.readAsDataURL(file);
        }
      }

      cropper = new Cropper(image, {
        dragMode: 'move',
        aspectRatio: 1/1.6,
        autoCropArea: 0.65,
        restore: false,
        guides: false,
        center: false,
        highlight: false,
        cropBoxMovable: true,
        cropBoxResizable: true,
        toggleDragModeOnDblclick: false,
      });
    });

    function makeid(length) {
        var result           = '';
        var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        var charactersLength = characters.length;
        for ( var i = 0; i < length; i++ ) {
          result += characters.charAt(Math.floor(Math.random() * 
          charactersLength));
        }
        return result;
    }


    document.getElementById('crop').addEventListener('click', function () {
      var initialAvatarURL;
      var canvas;

      if (cropper) {
        canvas = cropper.getCroppedCanvas({
          height: 1200,
        });
        initialAvatarURL = avatar.src;
        avatar.src = canvas.toDataURL();

        canvas.toBlob(function (blob) {
          let fileInputElement = document.getElementById('input');
          let data = blob;
          let file = new File([data], ""+makeid(10)+'.'+(blob.type == 'image/jpeg' ? 'jpg' : (blob.type == 'image/png' ? 'png' : 'png') )+"",{type:blob.type, lastModified:new Date().getTime()});
          let container = new DataTransfer();
          container.items.add(file);
          fileInputElement.files = container.files;
        });
      }
    });
  });
</script>
@endpush

@endsection