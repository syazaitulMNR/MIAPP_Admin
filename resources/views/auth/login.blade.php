@if(!isset(Auth::user()->id))

@extends('layouts.app', [
    'namePage' => 'Login page',
    'class' => 'login-page sidebar-mini ',
    'activePage' => 'login',
    'backgroundImage' => asset('assets') . "/img/bg14.jpg",
])

@section('contentGuest')
    <div class="content">
        <div class="container">
            <div class="col-md-12 ml-auto mr-auto">
                <div class="header bg-gradient-primary py-10 py-lg-2 pt-lg-12">
                    <div class="container">
                        <div class="header-body text-center mb-7">
                            <div class="row justify-content-center">
                                <div class="col-lg-12 col-md-9">
                                    <p class="text-lead text-light mt-3 mb-0">
                                        @include('alerts.migrations_check')
                                    </p>
                                </div>
                                <div class="col-lg-5 col-md-6">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 ml-auto mr-auto">
                <form role="form" method="POST" action="{{ route('login') }}">
                @csrf
                    <div class="card card-login card-plain">
                        <div class="card-header text-center pb-3">
                            <img src="{{ asset('assets/img/icon_1.png') }}" style="max-width:50%" alt="">
                        </div>

                        @if(session('error'))          
                            <div class="alert alert-danger">
                                <button type="button" aria-hidden="true" class="close">
                                    <i class="now-ui-icons ui-1_simple-remove"></i>
                                </button>
                                <small>{{ session('error') }}</small>
                            </div>
                        @endif

                        <div class="card-body ">
                            <div class="input-group no-border form-control-lg">
                                <span class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="now-ui-icons users_circle-08"></i>
                                </div>
                                </span>
                                <input class="form-control" placeholder="Please Enter Email" type="email" name="email" required autofocus>
                            </div>

                            <div class="input-group no-border form-control-lg">
                                <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="now-ui-icons objects_key-25"></i></i>
                                </div>
                                </div>
                                <input class="form-control" name="password" placeholder="Please Enter Password" type="password" required>
                            </div>
                    
                        </div>
                        <div class="card-footer">
                            <button  type = "submit" class="btn btn-primary btn-round btn-lg btn-block mb-3">{{ __('Get Started') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
        demo.checkFullPageBackgroundImage();
        });
    </script>
@endpush

@else
    {{ Session::flush(); }}

    <script>
        location.replace("{{ url('/') }}");
    </script>   
  
@endif