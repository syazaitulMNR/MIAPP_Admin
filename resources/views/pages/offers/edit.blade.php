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
                <div class="nav nav-tabs nav-justified bd-highlight" style="font-size: 9pt" id="nav-tab">
                  <button class="nav-link active" id="nav-detail-tab" href="#nav-detail-tab" data-bs-toggle="tab" data-bs-target="#nav-detail" type="button" role="tab" aria-controls="nav-detail" aria-selected="true">Details</button>
                  <button class="nav-link" id="nav-tnc-tab" data-bs-toggle="tab" data-bs-target="#nav-tnc" type="button" role="tab" aria-controls="nav-tnc" aria-selected="false">Terms & Conditions</button>
                  <button class="nav-link " id="nav-poster-tab" data-bs-toggle="tab" data-bs-target="#nav-poster" type="button" role="tab" aria-controls="nav-poster" aria-selected="false">Poster</button>
                  <button class="nav-link {{ !empty($tabName) && $tabName == 'nav-apply' ? 'active' : '' }}" id="nav-apply-tab"data-bs-toggle="tab" data-bs-target="#nav-apply" type="button" role="tab" aria-controls="nav-apply" aria-selected="false">Applicable List</button>
                </div>
              </nav>

              <div class="tab-content pt-4" id="nav-tabContent">
                <!--------------------------------- DETAILS --------------------------------------------->
                <div class="tab-pane fade show active" id="nav-detail" role="tabpanel" aria-labelledby="nav-detail-tab">
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
                        <select class="form-control" name="type" required>
                          <option value="Merchandise" {{ $offer->type == 'Merchandise' ? 'selected' : '' }} >Merchandise</option>
                          <option value="Event" {{ $offer->type == 'Event' ? 'selected' : '' }} >Event</option>
                          <option value="Merchandise + Event" {{ $offer->type == 'Merchandise + Event' ? 'selected' : '' }} >Merchandise + Event</option>
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
                        <input type="text" name="onpay_link" class="form-control" placeholder="Insert OnPay Link (Refer Onpay)" value="{{ $offer->onpay_link }}" required>
                        @include('alerts.feedback', ['field' => 'onpay_link'])
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>{{__(" Promo Code")}}<span class="text-danger">*</span></label>
                        <input type="text" name="promo_code" class="form-control" placeholder="Insert Promo Code" value="{{ $offer->promo_code }}" required>
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

                  </div>
                </div>

                <!--------------------------------- TNC --------------------------------------------->
                <div class="tab-pane fade" id="nav-tnc" role="tabpanel" aria-labelledby="nav-tnc-tab">
                  <div class="col-md-12">

                    <div class="row">
                      <div class="col-md-12 pr-1">
                        <div class="form-group">
                          <label>{{__(" Terms And Conditions")}}<span class="text-danger">*</span></label>
                          <textarea rows="3" class="form-control" id="compose" name="tnc" placeholder="Insert Terms And Conditions" required>{!! $offer->tnc !!}</textarea>
                          @include('alerts.feedback', ['field' => 'tnc'])
                        </div>
                      </div>
                    </div>

                  </div>
                </div>

                <!--------------------------------- POSTER --------------------------------------------->
                <div class="tab-pane fade" id="nav-poster" role="tabpanel" aria-labelledby="nav-poster-tab">
                  <div class="col-md-12">

                    <div class="col-md-12 pr-1 align-center">
                      <div class="form-group">
                        <label>{{__(" Promo Image")}}<span class="text-danger">*</span></label>
                        <input type="file" name="img_path" class="form-control" placeholder="Insert Promotion's Image">
                        @include('alerts.feedback', ['field' => 'img_path'])
                      </div>
                    </div>

                    <div class="col-md-12 pb-3 text-center">
                      <img class="card-img-top" src="{{ $offer->img_path }}" style="max-width:50%">
                    </div>
                    
                    
                  </div>
                </div>

                <!--------------------------------- APPLICABLE --------------------------------------------->
                <div class="tab-pane fade" id="nav-apply" role="tabpanel" aria-labelledby="nav-apply-tab">
                  <div class="col-md-12">

                    <div class="row">
                      <div class="col-md-12 pr-1">
                        <div class="form-group">
                          <label>Can Select Multiple Product/Event<span class="text-danger">*</span></label>
                        </div>
                      </div>
                    </div>
                        
                    <!-- PRODUCT -->
                    <div class="col-md-6 pr-1">
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
                          <div class="checkbox checkbox-info checkbox-inline">
                            <input class="age_group_checkbox" type="checkbox" value="{{$products->id}}" name="product[]" @foreach ($applyProduct as $ids) @if($products->id == $ids->product_id ) checked @endif @endforeach />
                            <label>{{$products->product_name}}</label>
                          </div>
                        @endforeach
                      </div>
                    </div>

                    <!-- EVENT -->
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
                        @foreach ($program as $programs)
                          <div class="checkbox checkbox-info checkbox-inline">
                            <input class="age_group_checkbox" type="checkbox" value="{{$programs->id}}" name="program[]" @foreach ($applyProgram as $ids) @if($programs->id == $ids->program_id ) checked @endif @endforeach />
                            <label>{{$programs->program_name}}</label>
                          </div>
                        @endforeach
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