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
                          <label>{{__(" Name")}}<span class="text-danger">*</span></label>
                          <input type="text" name="ebook_name" class="form-control" value="{{ old('ebook_name') }}" placeholder="Insert EBook Name" required>
                          @include('alerts.feedback', ['field' => 'ebook_name'])
                      </div>
                    </div>
                  </div>

                <div class="row">
                  <div class="col-md-12 pr-1">
                    <div class="form-group">
                      <label>{{__(" Description")}}</label>
                      <textarea rows="2" class="form-control" name="desc" placeholder="Insert EBook's Description" >{{ old('desc') }}</textarea>
                      @include('alerts.feedback', ['field' => 'desc'])
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-12 pr-1">
                    <div class="form-group">
                      <label>{{__(" EBook Cover")}}<span class="text-danger">*</span></label>
                      <input type="file" name="ebook_cover" class="form-control" id="input" accept="image/*">
                      @include('alerts.feedback', ['field' => 'ebook_cover'])
                    </div>
                    <small class="text-danger float-right">*Suggestion size: 1250 x 1760 px</small>
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
                </div>

                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="exampleInputEmail1">{{__(" PDF File")}}<span class="text-danger">*</span></label>
                      <input type="file" name="ebook_pdf" class="form-control" placeholder="Insert EBook's Description" required>
                      @include('alerts.feedback', ['field' => 'ebook_pdf'])
                    </div>
                    <small class="text-danger float-right">*Max size: 10 mb</small>
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
@endsection