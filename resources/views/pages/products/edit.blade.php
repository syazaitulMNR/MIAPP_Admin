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
            <h5 class="title" style="text-transform: capitalize">Edit - {{ $product->product_name }}</h5>
          </div>

          <div class="card-body">

            <form method="post" action="{{ route('product.update', $product->id) }}" autocomplete="off" enctype="multipart/form-data" >
              @csrf
              @include('alerts.success')
              
              <div class="col-md-12">

                <div class="row">
                  <div class="col-md-7 pr-1">

                    <div class="row">
                      <div class="col-md-6 pr-1">
                        <div class="form-group">
                          <label>{{__(" Product ID")}}<span class="text-danger">*</span></label>
                          <input type="text" name="product_id" class="form-control" placeholder="Insert Product ID (Refer Onpay)" style="text-transform: uppercase" value="{{ $product->product_id }}"  required>
                          @include('alerts.feedback', ['field' => 'product_id'])
                        </div>
                      </div>

                      <div class="col-md-6 pr-1">
                        <div class="form-group">
                          <label>{{__(" Product Name")}}<span class="text-danger">*</span></label>
                          <input type="text" name="product_name" class="form-control" placeholder="Insert Product Name" style="text-transform: capitalize" value="{{ $product->product_name }}" required>
                          @include('alerts.feedback', ['field' => 'product_name'])
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-12 pr-1">
                        <div class="form-group">
                          <label>{{__(" Description (Optional)")}}</label>
                          <textarea rows="2" class="form-control" name="desc" placeholder="Insert Product's Description" value="{{ $product->desc }}" >{{ $product->desc }}</textarea>
                          @include('alerts.feedback', ['field' => 'desc'])
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-12 pr-1">
                        <div class="form-group">
                          <label>{{__(" Product Image (Optional)")}}</label>
                          <input type="file" name="img_path" class="form-control" placeholder="Insert Product's Image">
                          @include('alerts.feedback', ['field' => 'img_path'])
                        </div>
                      </div>
                    </div>

                    <div class="card-footer text-right">
                      <a href="{{ route('products') }}" class="btn btn-danger btn-round">{{__('Cancel')}}</a>
                      <button type="submit" class="btn btn-success btn-round">{{__('Save')}}</button>
                    </div>

                  </div>

                  <div class="col-md-5 text-center">
                    <img class="card-img-top" src="{{ asset($product->img_path) }}" style="max-width:50%">
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

@endsection