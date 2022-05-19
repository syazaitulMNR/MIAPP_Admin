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
            <h5 class="title" style="text-transform: capitalize">Edit - {{ $offer->offer_name }}</h5>
          </div>

          <div class="card-body">
            <div class="col-md-12">

            <form method="post" action="{{ route('offer.update', $offer->id) }}" autocomplete="off" enctype="multipart/form-data" >
              @csrf
              @include('alerts.success')
              <nav>
                <div class="nav nav-tabs nav-justified bd-highlight" id="v-pills-tab" role="tablist">
                  <a class="nav-link active" id="v-pills-detail-tab" data-toggle="pill" href="#v-pills-detail" role="tab" aria-controls="v-pills-detail" aria-selected="true">Details</a>
                  <a class="nav-link" id="v-pills-tnc-tab" data-toggle="pill" href="#v-pills-tnc" role="tab" aria-controls="v-pills-tnc" aria-selected="false">Terms & Conditions</a>
                  <a class="nav-link" id="v-pills-poster-tab" data-toggle="pill" href="#v-pills-poster" role="tab" aria-controls="v-pills-poster" aria-selected="false">Poster</a>
                  <a class="nav-link" id="v-pills-apply-tab" data-toggle="pill" href="#v-pills-apply" role="tab" aria-controls="v-pills-apply" aria-selected="false">Applicable List</a>
                </div>
              </nav>

              <div class="tab-content pt-3" id="v-pills-tabContent">
                <!--------------------------------- DETAILS --------------------------------------------->
                <div class="tab-pane fade show active" id="v-pills-detail" role="tabpanel" aria-labelledby="v-pills-detail-tab">
                  <div class="col-md-12">

                  <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>{{__(" Promotion ID")}}<span class="text-danger">*</span></label>
                        <input type="text" name="offer_id" class="form-control" placeholder="Insert Promo ID (Refer Onpay)" value="{{ $offer->offer_id }}" required>
                        @include('alerts.feedback', ['field' => 'offer_id'])
                      </div>
                    </div>

                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>{{__(" Promotion Name")}}<span class="text-danger">*</span></label>
                        <input type="text" name="offer_name" class="form-control" placeholder="Insert Promotion Name" value="{{ $offer->offer_name }}" required>
                        @include('alerts.feedback', ['field' => 'offer_name'])
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>{{__(" Promotion Type")}}<span class="text-danger">*</span></label>
                        <select class="form-control" name="type" onchange="ableCheckBox(this)" required>
                          <option value="Product" {{ $offer->type == 'Product' ? 'selected' : '' }} >Product</option>
                          <option value="Event" {{ $offer->type == 'Event' ? 'selected' : '' }} >Event</option>
                          <option value="Product + Event" {{ $offer->type == 'Product + Event' ? 'selected' : '' }} >Product + Event</option>
                        </select>
                        @include('alerts.feedback', ['field' => '	type'])
                      </div>
                    </div>

                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>{{__(" Valid Until")}}<span class="text-danger">*</span></label>
                        <input type="datetime-local" name="valid_until" class="form-control" value="{{ date('Y-m-d\TH:i', strtotime($offer->valid_until)) }}" required>
                        @include('alerts.feedback', ['field' => 'valid_until'])
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>{{__(" Promo Code")}}</label>
                        <input type="text" name="promo_code" class="form-control" placeholder="Insert Promo Code" value="{{ $offer->promo_code }}">
                        @include('alerts.feedback', ['field' => 'promo_code'])
                      </div>
                    </div>

                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>{{__(" Status")}}<span class="text-danger">*</span></label>
                        <select class="form-control" name="status" required>
                          <option value="Active" {{ $offer->status == 'Active' ? 'selected' : '' }} >Active</option>
                          <option value="Deactive" {{ $offer->status == 'Deactive' ? 'selected' : '' }} >Deactive</option>
                        </select>
                        @include('alerts.feedback', ['field' => 'status'])
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-12 pr-1">
                      <div class="form-group">
                        <label>{{__(" Description")}}</label>
                        <textarea rows="2" class="form-control" name="desc" placeholder="Insert Promotion's Description" >{{ $offer->desc }}</textarea>
                        @include('alerts.feedback', ['field' => 'desc'])
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-12 pr-1">
                      <div class="form-group">
                        <label>{{__(" OnPay Link")}}<span class="text-danger">*</span></label>
                        <a class="btn btn-primary btn-sm btn-icon text-white " value="copy" onclick="copyToClipboard('copy_{{ $offer->onpay_link }}')" data-bs-toggle="tooltip" data-bs-placement="top" title="Copy Link">
                          <i class="now-ui-icons files_single-copy-04"></i>
                        </a>
                        <a class="btn btn-primary btn-sm btn-icon text-white" target="_blank" href="{{ $offer->onpay_link }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Go To Page">
                          <i class="now-ui-icons media-1_button-play"></i>
                        </a>
                        <input type="text" name="onpay_link" id="copy_{{ $offer->onpay_link }}" class="form-control" placeholder="Insert OnPay Link (Refer Onpay)" value="{{ $offer->onpay_link }}" required>
                        @include('alerts.feedback', ['field' => 'onpay_link'])
                      </div>
                    </div>
                  </div>

                  </div>
                </div>

                <!--------------------------------- TNC --------------------------------------------->
                <div class="tab-pane fade" id="v-pills-tnc" role="tabpanel" aria-labelledby="v-pills-tnc-tab">
                  <div class="col-md-12">

                    <div class="row">
                      <div class="col-md-12 pr-1">
                        <div class="form-group">
                          <label>{{__(" Terms And Conditions")}}<span class="text-danger">*</span></label>
                          <textarea class="form-control" id="compose" name="tnc" placeholder="Insert Terms And Conditions" required>{!! $offer->tnc !!}</textarea>
                          @include('alerts.feedback', ['field' => 'tnc'])
                        </div>
                      </div>
                    </div>

                  </div>
                </div>

                <!--------------------------------- POSTER --------------------------------------------->
                <div class="tab-pane fade" id="v-pills-poster" role="tabpanel" aria-labelledby="v-pills-poster-tab">
                  <div class="col-md-12 pb-3 text-center">
                    <img class="card-img-top" src="{{ $offer->img_path }}" style="max-width:50%">
                  </div>
                  
                  <div class="col-md-12">
                    
                    <div class="col-md-12 pr-1 align-center">
                      <div class="form-group">
                        <label>{{__(" Promo Image")}}<span class="text-danger">*</span></label>
                        <input type="file" name="img_path" class="form-control" id="input" accept="image/*"  placeholder="Insert Promotion's Image">
                        @include('alerts.feedback', ['field' => 'img_path'])
                      </div>
                    </div>  
                  
                    <div class="row">
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
                    
                  </div>
                </div>

                <!--------------------------------- APPLICABLE --------------------------------------------->
                <div class="tab-pane fade" id="v-pills-apply" role="tabpanel" aria-labelledby="v-pills-apply-tab">
                  <div class="col-md-12">

                    <div class="row">
                      <div class="col-md-12 pr-1">
                        <div class="form-group">
                          <label>Can Select Multiple Product/Event<span class="text-danger">*</span></label>
                        </div>
                      </div>
                    </div>
                    
                    <div class="row">
                      <!---------------------------------------------------PRODUCT CHECKBOX------------------------------------------------------------------->
                      <div class="col-md-6 pr-1 pb-5">
                        <div class="form-group">
                          <h6>Product</h6>
                          <div class="row">
                            @foreach($applyProduct as $data)
                              @foreach($product as $products)
                                @if ($products->id == $data->product_id)
                                  <a href="" class="btn btn-primary btn-sm btn-outline-primary" disable>{{ $products -> product_name }}</a> &nbsp;
                                @endif
                              @endforeach
                            @endforeach
                          </div>
                          @foreach ($product as $products)
                            <div class="form-check" id="ElementPd">
                              <label class="form-check-label">
                              <input class="age_group_checkbox" type="checkbox" value="{{$products->id}}" name="product[]" @foreach ($applyProduct as $ids) @if($products->id == $ids->product_id ) checked @endif @endforeach />
                                {{$products->product_name}}
                                <span class="form-check-sign">
                                    <span class="check"></span>
                                </span>
                              </label>
                            </div>
                          @endforeach
                        </div>
                      </div>

                      <!---------------------------------------------------EVENT CHECKBOX------------------------------------------------------------------->
                      <div class="col-md-6 pr-1">
                        <div class="form-group">
                          <h6>Event</h6>
                          <div class="row">
                            @foreach($applyProgram as $data)
                              @foreach($program as $programs)
                                @if ($programs->id == $data->program_id)
                                  <a href="" class="btn btn-primary btn-sm btn-outline-primary" disable>{{ $programs -> program_name }}</a> &nbsp;
                                @endif
                              @endforeach
                            @endforeach
                          </div>
                          @foreach($program as $programs)
                            <div class="form-check" id="ElementPg">
                              <label class="form-check-label">
                              <input class="form-check-input" type="checkbox" value="{{$programs->id}}" name="program[]" @foreach ($applyProgram as $ids) @if($programs->id == $ids->program_id ) checked @endif @endforeach />
                                {{$programs->program_name}}
                                <span class="form-check-sign">
                                    <span class="check"></span>
                                </span>
                              </label>
                            </div>
                          @endforeach
                        </div>
                      </div>

                    </div>

                  </div>
                </div>
                <!--------------------------------- END APPLICABLE --------------------------------------------->
              </div>
              <!--------------------------------- END CONTENT SECTION--------------------------------------------->
              <hr class="half-rule"/>
                <div class="card-footer text-right">
                  <a href="{{ route('offers') }}" class="btn btn-danger btn-round">{{__('Back')}}</a>
                  <button type="submit" class="btn btn-success btn-round">{{__('Save')}}</button>
                </div>
                

              </div>
            </form>

            </div>
          </div>
          
        </div>
      </div>
    </div>
  </div>
  
<script type="text/javascript">
    
    // TEXTAREA 
    $('#compose').summernote({
        placeholder: 'Please Insert Terms And Condition',
        tabsize: 2,
        height: 250,
        toolbar: [
          ['style', ['style']],
          ['font', ['bold', 'underline', 'clear']],
          ['fontname', ['fontname']],
          ['para', ['ul', 'ol', 'paragraph']],
        ]
      });

      $(function () {
  $('[data-toggle="tooltip"]').tooltip()
});

    // COPY LINK
    function copyToClipboard(onpay_link) {
        document.getElementById(onpay_link).select();
        document.execCommand('copy');
        alert("Copied text to clipboard: " + event.data["text/plain"] );
    }
    
    // REDIRECT TAB FUNCTION
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
            });
        }, false);
    })();

    $(document).ready(function () {
        $('#v-pills-tab a[href="#{{ old('pill') }}"]').tab('show')
    });

    // Checkbox function for product & program
    function ableCheckBox(opts) {
      var pdChks = document.getElementsByName("product[]");
      var pgChks = document.getElementsByName("program[]");

      if (opts.value == 'Product') { //DISABLE Product, ABLE Program
        for (var i = 0; i <= pdChks.length - 1; i++) {
          pdChks[i].disabled = false;
          $('#ElementPd').removeClass('disabled');
        }
        for (var i = 0; i <= pgChks.length - 1; i++) {
          pgChks[i].disabled = true;
          pgChks[i].checked = false;
          $('#ElementPg').addClass('disabled');
        }

      } else if (opts.value == 'Event') { //ABLE Product, DISABLE Program
        for (var i = 0; i <= pdChks.length - 1; i++) {
          pdChks[i].disabled = true;
          pdChks[i].checked = false;
          $('#ElementPd').addClass('disabled');
        }
        for (var i = 0; i <= pgChks.length - 1; i++) {
          pgChks[i].disabled = false;
          $('#ElementPg').removeClass('disabled');
        }

      } else if (opts.value == 'Product + Event') { //ABLE both
        for (var i = 0; i <= pdChks.length - 1; i++) {
          pdChks[i].disabled = false;
          $('#ElementPd').removeClass('disabled');
        }
        for (var i = 0; i <= pgChks.length - 1; i++) {
          pgChks[i].disabled = false;
          $('#ElementPg').removeClass('disabled');
        }

      } else { //DISABLE both
        for (var i = 0; i <= pdChks.length - 1; i++) {
          pdChks[i].disabled = true;
          pdChks[i].checked = false;
          $('#ElementPd').addClass('disabled');
        }
        for (var i = 0; i <= pgChks.length - 1; i++) {
          pgChks[i].disabled = true;
          pgChks[i].checked = false;
          $('#ElementPg').addClass('disabled');
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