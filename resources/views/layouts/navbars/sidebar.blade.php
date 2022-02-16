<div class="sidebar" data-color="orange">
  <!--
    Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
-->
  <div class="logo">
    <!-- <a class="simple-text logo-mini" type="image/png" rel="icon" href="{{ asset('assets') }}/img/icon_1.png">
      
    </a> -->
    <img class="card-img-top" href="asset/img/icon_1.png" style="max-width:50%">
    <a href="" class="simple-text logo-normal">
      {{ __('Momentum Internet') }}
    </a>
  </div>

  <div class="sidebar-wrapper" id="sidebar-wrapper">
    <ul class="nav">

      <li class= "{{ Route::currentRouteName() == 'home' ? 'active' : '' }}">
        <a href="{{ route('home') }}">
          <i class="now-ui-icons design_app"></i>
          <p>{{ __('Dashboard') }}</p>
        </a>
      </li>

      <li class = "{{ Route::currentRouteName() == 'programs' ? 'active' : '' }}">
        <a href="{{ route('programs') }}">
          <i class="now-ui-icons tech_tv"></i>
          <p>{{ __('Event Management') }}</p>
        </a>
      </li>

      <li class = "{{ Route::currentRouteName() == 'ebooks' ? 'active' : '' }}">
        <a href="{{ route('ebooks') }}">
          <i class="now-ui-icons education_agenda-bookmark"></i>
          <p>{{ __('Ebook Management') }}</p>
        </a>
      </li>

      <li class = "{{ Route::currentRouteName() == 'products' ? 'active' : '' }}">
        <a href="{{ route('products') }}">
          <i class="now-ui-icons objects_diamond"></i>
          <p>{{ __('Product Management') }}</p>
        </a>
      </li>

      <li class = "{{ Route::currentRouteName() == 'offers' ? 'active' : '' }}">
        <a href="{{ route('offers') }}">
          <i class="now-ui-icons shopping_basket"></i>
          <p>{{ __('Promo Management') }}</p>
        </a>
      </li>

      <li class = "{{ Route::currentRouteName() == 'users' ? 'active' : '' }}">
        <a href="{{ route('users') }}">
          <i class="now-ui-icons users_single-02"></i>
          <p>{{ __('User Management') }}</p>
        </a>
      </li>

    </ul>
  </div>

</div>
