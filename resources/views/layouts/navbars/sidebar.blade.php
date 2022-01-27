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

    </ul>
  </div>

</div>
