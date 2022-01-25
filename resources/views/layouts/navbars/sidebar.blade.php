<div class="sidebar" data-color="orange">
  <!--
    Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
-->
  <div class="logo">
    <a href="" class="simple-text logo-mini">
      {{ __('MI') }}
    </a>
    <a href="" class="simple-text logo-normal">
      {{ __('Momentum Internet') }}
    </a>
  </div>

  <div class="sidebar-wrapper" id="sidebar-wrapper">
    <ul class="nav">

      <li class="">
        <a href="">
          <i class="now-ui-icons design_app"></i>
          <p>{{ __('Dashboard') }}</p>
        </a>
      </li>

      <li class = "{{ Route::currentRouteName() == 'programs' ? 'active' : '' }}">
        <a href="{{ route('programs') }}">
          <i class="now-ui-icons tech_tv"></i>
          <p>{{ __('Program Management') }}</p>
        </a>
      </li>

      <li class = "{{ Route::currentRouteName() == 'ebooks' ? 'active' : '' }}">
        <a href="{{ route('ebooks') }}">
          <i class="now-ui-icons education_agenda-bookmark"></i>
          <p>{{ __('ebooks') }}</p>
        </a>
      </li>

      <li>
        <a data-toggle="collapse" href="#laravelExamples">
            <i class="fab fa-laravel"></i>
          <p>
            {{ __("Laravel Examples") }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse show" id="laravelExamples">
          <ul class="nav">
            <li class="">
              <a href="">
                <i class="now-ui-icons users_single-02"></i>
                <p> {{ __("User Profile") }} </p>
              </a>
            </li>
            <li class="">
              <a href="">
                <i class="now-ui-icons design_bullet-list-67"></i>
                <p> {{ __("User Management") }} </p>
              </a>
            </li>
          </ul>
        </div>
    

      <li class="">
        <a href="">
          <i class="now-ui-icons education_atom"></i>
          <p>{{ __('Icons') }}</p>
        </a>
      </li>

      <li class = "">
        <a href="">
          <i class="now-ui-icons location_map-big"></i>
          <p>{{ __('Maps') }}</p>
        </a>
      </li>

      <li class = "">
        <a href="">
          <i class="now-ui-icons ui-1_bell-53"></i>
          <p>{{ __('Notifications') }}</p>
        </a>
      </li>

      <li class = "">
        <a href="">
          <i class="now-ui-icons design_bullet-list-67"></i>
          <p>{{ __('Table List') }}</p>
        </a>
      </li>

      <li class = "">
        <a href="">
          <i class="now-ui-icons text_caps-small"></i>
          <p>{{ __('Typography') }}</p>
        </a>
      </li>

    </ul>
  </div>

</div>
