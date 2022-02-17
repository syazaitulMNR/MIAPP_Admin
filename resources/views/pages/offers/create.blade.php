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

                <div class="row">
                  <div class="col-md-6 pr-1">
                    <div class="form-group">
                      <label>{{__(" Promotion Type")}}<span class="text-danger">*</span></label>
                      <select class="form-control" name="type" required>
                        <option value="">Please Select...</option>
                        <option value="Merchandise">Merchandise</option>
                        <option value="Event">Event</option>
                        <option value="Merchandise + Event">Merchandise + Event</option>
                      </select>
                      @include('alerts.feedback', ['field' => '	type'])
                    </div>
                  </div>

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

                <div class="row">
                  <div class="col-md-12 pr-1">
                    <div class="form-group">
                      <label>Applicable To (Select Multiple Product/Event)<span class="text-danger">*</span></label>
                    </div>
                  </div>
                </div>
                

                <div class="row">
                  <div class="col-md-6 pr-1">
                    <div class="form-group">
                      <label>Product</label>
                      @foreach($product as $tag)
                        <div class="form-check">
                          <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" name="product[]" value="{{$tag->id}}" >
                            {{$tag->product_name}}
                            <span class="form-check-sign">
                                <span class="check"></span>
                            </span>
                          </label>
                        </div>
                      @endforeach
                    </div>
                  </div>

                  <div class="col-md-6 pr-1">
                    <div class="form-group">
                      <label>Event</label>
                      @foreach($program as $data)
                        <div class="form-check">
                          <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" name="program[]" value="{{$data->id}}" >
                            {{$data->program_name}}
                            <span class="form-check-sign">
                                <span class="check"></span>
                            </span>
                          </label>
                        </div>
                      @endforeach
                    </div>
                  </div>
                </div>

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
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
        ]
      });
  </script>

@endsection