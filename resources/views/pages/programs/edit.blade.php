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
            <h5 class="title" style="text-transform: capitalize">Edit - {{ $program->program_name }}</h5>
          </div>

          <div class="card-body">

            <form method="post" action="{{ route('program.update', $program->id) }}" autocomplete="off" enctype="multipart/form-data" >
              @csrf
              @include('alerts.success')
              
              <div class="col-md-12">

                <div class="row">
                  <div class="col-md-12 pb-3 text-center">
                    <img class="card-img-top" src="{{ $program->img_path }}" style="max-width:50%">
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>{{__(" Event ID")}}<span class="text-danger">*</span></label>
                        <input type="text" name="program_id" class="form-control" placeholder="Insert Program ID (Refer MIMS)" value="{{ $program->program_id }}" required>
                        @include('alerts.feedback', ['field' => 'program_id'])
                      </div>
                  </div>

                  <div class="col-md-6 pr-1">
                    <div class="form-group">
                      <label>{{__(" Event Name")}}<span class="text-danger">*</span></label>
                      <input type="text" name="program_name" class="form-control" placeholder="Insert Program Name" value="{{ $program->program_name }}" required>
                      @include('alerts.feedback', ['field' => 'program_name'])
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6 pr-1">
                    <div class="form-group">
                      <label>{{__(" Date Start")}}<span class="text-danger">*</span></label>
                      <input type="datetime-local" name="date_start" class="form-control" value="{{ date('Y-m-d\TH:i', strtotime($program->date_start)) }}" required>
                      @include('alerts.feedback', ['field' => 'date_start'])
                    </div>
                  </div>
    
                  <div class="col-md-6 pr-1">
                    <div class="form-group">
                      <label>{{__(" Date End")}}<span class="text-danger">*</span></label>
                      <input type="datetime-local" name="date_end" class="form-control" value="{{ date('Y-m-d\TH:i', strtotime($program->date_end)) }}" required>
                      @include('alerts.feedback', ['field' => '	date_end'])
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-12 pr-1">
                    <div class="form-group">
                        <label>{{__(" Web Link")}}<span class="text-danger">*</span></label>
                        <a class="btn btn-primary btn-sm btn-icon text-white " value="copy" onclick="copyToClipboard('copy_{{ $program->page_link }}')" title="Copy Link"><i class="now-ui-icons files_single-copy-04"></i></a>
                        <a class="btn btn-primary btn-sm btn-icon text-white" target="_blank" href="{{ $program->page_link }}"><i class="now-ui-icons media-1_button-play" title="Go to Page"></i></a>                        
                      <input type="text" id="copy_{{ $program->page_link }}" name="page_link" class="form-control" placeholder="Insert Link of Program's Landing Page" value="{{ $program->page_link }}" required>
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
                    <small class="text-danger float-right">*Suggestion size: 1920 x 1080 px</small>
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
                        <option value="Active" {{ $program->status == 'Active' ? 'selected' : '' }} >Active</option>
                        <option value="Deactive" {{ $program->status == 'Deactive' ? 'selected' : '' }} >Deactive</option>
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

  <script>
    // COPY LINK
    function copyToClipboard(page_link) {
        document.getElementById(page_link).select();
        document.execCommand('copy');
        alert("Copied text to clipboard: " + event.data["text/plain"] );
    }
  </script>
@endsection

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
        aspectRatio: 1.8/1,
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
          width: 1350,
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