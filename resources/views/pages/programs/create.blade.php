@extends('layouts.app')

@section('content')
  <div class="panel-header panel-header-sm">
  </div>
  <div class="content">
    <div class="row">
      <div class="col-md-12">
        
        <div class="card">

          <div class="card-header">
            <h5 class="title">Create New Event</h5>
          </div>

          <div class="card-body">

            <form method="post" action="{{ route('program.save') }}" autocomplete="off" enctype="multipart/form-data" >
              @csrf
              @include('alerts.success')
              
              <div class="col-md-12">

                <div class="row">
                  <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>{{__(" Event ID")}}<span class="text-danger">*</span></label>
                        <input type="text" name="program_id" class="form-control" placeholder="Insert Program ID (Refer MIMS)" required>
                        @include('alerts.feedback', ['field' => 'program_id'])
                      </div>
                  </div>

                  <div class="col-md-6 pr-1">
                    <div class="form-group">
                      <label>{{__(" Event Name")}}<span class="text-danger">*</span></label>
                      <input type="text" name="program_name" class="form-control" placeholder="Insert Program Name" required>
                      @include('alerts.feedback', ['field' => 'program_name'])
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6 pr-1">
                    <div class="form-group">
                      <label>{{__(" Date Start")}}<span class="text-danger">*</span></label>
                      <input type="datetime-local" name="date_start" class="form-control" required>
                      @include('alerts.feedback', ['field' => 'date_start'])
                    </div>
                  </div>
    
                  <div class="col-md-6 pr-1">
                    <div class="form-group">
                      <label>{{__(" Date End")}}<span class="text-danger">*</span></label>
                      <input type="datetime-local" name="date_end" class="form-control" required>
                      @include('alerts.feedback', ['field' => '	date_end'])
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-12 pr-1">
                    <div class="form-group">
                      <label>{{__(" Web Link")}}<span class="text-danger">*</span></label>
                      <input type="text" name="page_link" class="form-control" placeholder="Insert Link of Program's Landing Page" required>
                      @include('alerts.feedback', ['field' => 'page_link'])
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-12 pr-1">
                    <div class="form-group">
                      <label>{{__(" Poster Image")}}<span class="text-danger">*</span></label>
                      <input type="file" name="img_path" class="form-control" id="input" accept="image/*" placeholder="Insert Program's Poster">
                      @include('alerts.feedback', ['field' => 'img_path'])
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
                      <img class="rounded" id="avatar" src="{{URL::to('/assets/img/no_program.png')}}" alt="avatar">
                    </div>
                </div>
    
                <div class="row">
                  <div class="col-md-6 pr-1">
                    <div class="form-group">
                      <label>{{__(" Status")}}<span class="text-danger">*</span></label>
                      <select class="form-control" name="status">
                        <option value="Active">Active</option>
                        <option value="Deactive">Deactive</option>
                      </select>
                      @include('alerts.feedback', ['field' => '	status'])
                    </div>
                  </div>
                </div>

                <div class="card-footer text-right">
                  <a href="{{ route('programs') }}" class="btn btn-danger btn-round">{{__('Cancel')}}</a>
                  <button type="submit" class="btn btn-success btn-round">{{__('Save')}}</button>
                </div>
                <hr class="half-rule"/>

              </div>
            </form>
          </div>

        </div>
      </div>
    </div>
  </div>

  @push('js')
  <script>
    window.addEventListener('DOMContentLoaded', function () {
      var avatar = document.getElementById('avatar');
      var image = document.getElementById('image');
      var input = document.getElementById('input');
      var cropper;
  
      input.addEventListener('change', function (e) {
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
          aspectRatio: 1.7/1,
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
            width: 450,
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