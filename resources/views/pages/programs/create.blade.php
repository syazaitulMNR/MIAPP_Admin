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
                  <div class="col-md-6 pr-1">
                    <div class="form-group">
                      <label>{{__(" Poster Image")}}<span class="text-danger">*</span></label>
                      <input type="file" name="img_path" class="form-control" placeholder="Insert Program's Poster" required>
                      @include('alerts.feedback', ['field' => 'img_path'])
                    </div>
                  </div>
    
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

@endsection