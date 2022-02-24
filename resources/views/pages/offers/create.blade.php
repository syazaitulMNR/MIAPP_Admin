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
                      <input type="text" name="offer_id" class="form-control" placeholder="Insert Promo ID (Refer Onpay)" required>
                      @include('alerts.feedback', ['field' => 'offer_id'])
                    </div>
                  </div>

                  <div class="col-md-6 pr-1">
                    <div class="form-group">
                      <label>{{__(" Promotion Name")}}<span class="text-danger">*</span></label>
                      <input type="text" name="offer_name" class="form-control" placeholder="Insert Promotion Name" required>
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
                      <input type="datetime-local" name="valid_until" class="form-control" required>
                      @include('alerts.feedback', ['field' => 'valid_until'])
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-12 pr-1">
                    <div class="form-group">
                      <label>{{__(" Description")}}</label>
                      <textarea rows="2" class="form-control" name="desc" placeholder="Insert Promotion's Description" ></textarea>
                      @include('alerts.feedback', ['field' => 'desc'])
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-12 pr-1">
                    <div class="form-group">
                      <label>{{__(" OnPay Link")}} <span class="text-danger">*</span></label>
                      <input type="text" name="onpay_link" class="form-control" placeholder="Insert OnPay Link (Refer Onpay)" required>
                      @include('alerts.feedback', ['field' => 'onpay_link'])
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-4 pr-1">
                    <div class="form-group">
                      <label>{{__(" Promo Code")}}<span class="text-danger">*</span></label>
                      <input type="text" name="promo_code" class="form-control" placeholder="Insert Promo Code" required>
                      @include('alerts.feedback', ['field' => 'promo_code'])
                    </div>
                  </div>

                  <div class="col-md-4 pr-1">
                    <div class="form-group">
                      <label>{{__(" Promo Image")}}<span class="text-danger">*</span></label>
                      <input type="file" name="img_path" class="form-control" placeholder="Insert Product's Image" required>
                      @include('alerts.feedback', ['field' => 'img_path'])
                    </div>
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
                          <div class="form-check disabled" id="ElementPd">
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
                          <div class="form-check disabled" id="ElementPg">
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
                      <textarea rows="3" class="form-control" id="compose" name="tnc" placeholder="Insert Terms And Conditions" required></textarea>
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

@endsection