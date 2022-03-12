@extends('layouts.app')

@section('content')
  <div class="panel-header panel-header-sm">
  </div>
  <div class="content">
    <div class="row">
      <div class="col-md-12">

        <div class="card">

          <div class="card-header">
            <h5 class="title">Create New Promotion</h5>
          </div>

          <div class="card-body">

            <form method="post" action="{{ route('offer.save') }}" autocomplete="off" enctype="multipart/form-data" >
              @csrf
              @include('alerts.success')
              
              <div class="col-md-12">

                <div class="row">
                  <div class="col-md-6 pr-1">
                    <div class="form-group">
                      <label>{{__(" Promotion ID")}}<span class="text-danger">*</span></label>
                      <input type="text" name="offer_id" class="form-control" value="{{ old('offer_id') }}" placeholder="Insert Promo ID (Refer Onpay)" required>
                      @include('alerts.feedback', ['field' => 'offer_id'])
                    </div>
                  </div>

                  <div class="col-md-6 pr-1">
                    <div class="form-group">
                      <label>{{__(" Promotion Name")}}<span class="text-danger">*</span></label>
                      <input type="text" name="offer_name" class="form-control" value="{{ old('offer_name') }}" placeholder="Insert Promotion Name" required>
                      @include('alerts.feedback', ['field' => 'offer_name'])
                    </div>
                  </div>
                </div>
                  <!-------------------------------------SELECT TYPE---------------------------------------------------------------------->
                <div class="row">
                  <div class="col-md-6 pr-1">
                    <div class="form-group">
                      <label>{{__(" Promotion Type")}}<span class="text-danger">*</span></label>
                      <select class="form-control" name="type" id="type" onchange="ableCheckBox(this)" required>
                        <option value="">Please Select...</option>
                        <option value="Product">Product</option>
                        <option value="Event">Event</option>
                        <option value="Product + Event">Product + Event</option>
                      </select>
                      @include('alerts.feedback', ['field' => '	type'])
                    </div>
                  </div>
                  <!--------------------------------------------------------------------------------------------------------------------->
                  <div class="col-md-6 pr-1">
                    <div class="form-group">
                      <label>{{__(" Valid Until")}}<span class="text-danger">*</span></label>
                      <input type="datetime-local" name="valid_until" value="{{ old('valid_until') }}" class="form-control" required>
                      @include('alerts.feedback', ['field' => 'valid_until'])
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-12 pr-1">
                    <div class="form-group">
                      <label>{{__(" Description")}}</label>
                      <textarea rows="2" class="form-control" name="desc" placeholder="Insert Promotion's Description" >{{ old('desc') }}</textarea>
                      @include('alerts.feedback', ['field' => 'desc'])
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-12 pr-1">
                    <div class="form-group">
                      <label>{{__(" OnPay Link")}} <span class="text-danger">*</span></label>
                      <input type="text" name="onpay_link" class="form-control" value="{{ old('onpay_link') }}" placeholder="Insert OnPay Link (Refer Onpay)" required>
                      @include('alerts.feedback', ['field' => 'onpay_link'])
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6 pr-1">
                    <div class="form-group">
                      <label>{{__(" Promo Code")}}<span class="text-danger">*</span></label>
                      <input type="text" name="promo_code" class="form-control" value="{{ old('promo_code') }}" placeholder="Insert Promo Code" required>
                      @include('alerts.feedback', ['field' => 'promo_code'])
                    </div>
                  </div>

                  <div class="col-md-6 pr-1">
                    <div class="form-group">
                      <label>{{__(" Promo Image")}}<span class="text-danger">*</span></label>
                      <input type="file" name="img_path" class="form-control" placeholder="Insert Product's Image" required>
                      @include('alerts.feedback', ['field' => 'img_path'])
                    </div>
                    <small class="text-danger float-right">*Suggestion size: 1920 x 1080 px</small>
                  </div>

                  <div class="col-md-4 pr-1">
                    <div class="form-group">
                      <label>{{__(" Status")}}<span class="text-danger">*</span></label>
                      <select class="form-control" name="status" required>
                        <option value="Active">Active</option>
                        <option value="Deactive">Deactive</option>
                      </select>
                      @include('alerts.feedback', ['field' => 'status'])
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-12 pr-1">
                    <div class="form-group">
                      <label>{{__(" Promo Image")}}<span class="text-danger">*</span></label>
                      <input type="file" name="img_path" class="form-control" id="input" accept="image/*" placeholder="Insert Offer's Image">
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

                <hr class="half-rule"/>

                <div class="row">
                  <div class="col-md-12 pr-1">
                    <div class="form-group">
                      <label>Applicable To (Select Multiple Product/Event)<span class="text-danger">*</span></label>
                    </div>
                  </div>
                </div>
                
                <!---------------------------------------------------PRODUCT CHECKBOX------------------------------------------------------------------->
                <div class="row">
                  <div class="col-md-6 pr-1">
                    <div class="form-group">
                      <h6>Product</h6>
                      @if(!empty($product) && $product->count())
                        @foreach($product as $tag)
                          <div class="form-check 1 disabled" id="ElementPd[]">
                            <label class="form-check-label">
                              <input class="form-control form-control-lg" type="checkbox" name="product[]" id="products[]" value="{{$tag->id}}" disabled>
                              {{$tag->product_name}}
                              <span class="form-check-sign">
                                  <span class="check"></span>
                              </span>
                            </label>
                          </div>
                        @endforeach
                      @else
                        No data 
                        <a class="btn btn-primary btn-round text-white" href="{{ route('product.create') }}">
                          Add Product Now
                        </a>
                      @endif
                    </div>
                  </div>
                  <!-----------------------------------------------------PROGRAM CHECKBOX-------------------------------------------------------------->
                  <div class="col-md-6 pr-1">
                    <div class="form-group">
                      <h6>Event</h6>
                      @if(!empty($product) && $product->count())
                        @foreach($program as $data)
                          <div class="form-check 2 disabled" id="ElementPg[]">
                            <label class="form-check-label">
                              <input class="form-check-input" type="checkbox" name="program[]" id="programs[]" value="{{$data->id}}" disabled>
                              {{$data->program_name}}
                              <span class="form-check-sign">
                                  <span class="check"></span>
                              </span>
                            </label>
                          </div>
                        @endforeach
                      @else
                        No data 
                        <a class="btn btn-primary btn-round text-white" href="{{ route('program.create') }}">
                          Add Program Now
                        </a>
                      @endif
                    </div>
                  </div>
                </div>
                <!--------------------------------------------------------------------------------------------------------------------------------------->
                <hr class="half-rule"/>

                <div class="row">
                  <div class="col-md-12 pr-1">
                    <div class="form-group">
                      <label>{{__(" Terms And Conditions")}} <span class="text-danger">*</span></label>
                      <textarea rows="3" class="form-control" id="compose" name="tnc" placeholder="Insert Terms And Conditions" required>{{ old('tnc') }}</textarea>
                      @include('alerts.feedback', ['field' => 'tnc'])
                    </div>
                  </div>
                </div>
                
                <div class="card-footer text-right">
                  <a href="{{ route('offers') }}" class="btn btn-danger btn-round">{{__('Back')}}</a>
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

  <script type="text/javascript">
    $('#compose').summernote({
      placeholder: 'Please Insert Terms And Condition',
      tabsize: 2,
      height: 120,
      toolbar: [
        ['style', ['style']],
        ['font', ['bold', 'underline', 'clear']],
        ['fontname', ['fontname']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
      ]
    });

    // Checkbox function for product & program
    function ableCheckBox(opts) {
      var pdChks = document.getElementsByName("product[]"); //Product chkbox Function
      var pgChks = document.getElementsByName("program[]"); //Program chkbox Function
      var pdEle = document.getElementsByClassName("form-check 1"); //Product CSS
      var pgEle = document.getElementsByClassName("form-check 2"); //Program CSS

      if (opts.value == 'Product') { //CONDITION 1 = DISABLE Product, ABLE Program
        for (var i = 0; i <= pdChks.length - 1; i++) {
          pdChks[i].disabled = false;

          pdEle[i].classList.remove('disabled'); //remove 'disabled' from Product css
        }
        for (var i = 0; i <= pgChks.length - 1; i++) {
          pgChks[i].disabled = true;
          pgChks[i].checked = false;

          pgEle[i].classList.add('disabled'); //add 'disabled' from Program css
          
        }

      } else if (opts.value == 'Event') { //CONDITION 2 = ABLE Product, DISABLE Program
        for (var i = 0; i <= pdChks.length - 1; i++) {
          pdChks[i].disabled = true;
          pdChks[i].checked = false;

          pdEle[i].classList.add('disabled');
        }
        for (var i = 0; i <= pgChks.length - 1; i++) {
          pgChks[i].disabled = false;

          pgEle[i].classList.remove('disabled');
        }

      } else if (opts.value == 'Product + Event') { //CONDITION 3 = ABLE both
        for (var i = 0; i <= pdChks.length - 1; i++) {
          pdChks[i].disabled = false;

          pdEle[i].classList.remove('disabled');
        }
        for (var i = 0; i <= pgChks.length - 1; i++) {
          pgChks[i].disabled = false;
          
          pgEle[i].classList.remove('disabled');
        }

      } else { //CONDITION 4 = DISABLE both
        for (var i = 0; i <= pdChks.length - 1; i++) {
          pdChks[i].disabled = true;
          pdChks[i].checked = false;
          
          pdEle[i].classList.add('disabled');
        }
        for (var i = 0; i <= pgChks.length - 1; i++) {
          pgChks[i].disabled = true;
          pgChks[i].checked = false;
          
          pgEle[i].classList.add('disabled');
        }

      }
    }
    // END Checkbox function for product & program

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
  
@endsection