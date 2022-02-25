<div class="sidebar" data-color="orange">
  <!--
    Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
-->
  <div class="logo">
    <a href="{{ route('home') }}" class="simple-text logo-normal text-center">
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

      <li class = "{{ Route::currentRouteName() == 'ebooks' || Route::currentRouteName() == 'ebook.edit' || Route::currentRouteName() == 'ebook.create' ? 'active' : '' }}">
        <a href="{{ route('ebooks') }}">
          <i class="now-ui-icons education_agenda-bookmark"></i>
          <p>{{ __('Ebook Management') }}</p>
        </a>
      </li>
      
      <li class = "{{ Route::currentRouteName() == 'products'|| Route::currentRouteName() == 'product.edit' || Route::currentRouteName() == 'product.create' ? 'active' : '' }}">
        <a href="{{ route('products') }}">
          <i class="now-ui-icons objects_diamond"></i>
          <p>{{ __('Product Management') }}</p>
        </a>
      </li>

      <li class = "{{ Route::currentRouteName() == 'programs'|| Route::currentRouteName() =='program.edit' || Route::currentRouteName() == 'program.create' ? 'active' : '' }}">
        <a href="{{ route('programs') }}">
          <i class="now-ui-icons tech_tv"></i>
          <p>{{ __('Event Management') }}</p>
        </a>
      </li>

      <li class = "{{ Route::currentRouteName() == 'offers'|| Route::currentRouteName() =='offer.edit' || Route::currentRouteName() == 'offer.create' ? 'active' : '' }}">
        <a href="{{ route('offers') }}">
          <i class="now-ui-icons shopping_basket"></i>
          <p>{{ __('Promo Management') }}</p>
        </a>
      </li>

      <li class = "{{ Route::currentRouteName() == 'users'|| Route::currentRouteName() == 'user.view' ? 'active' : '' }}">
        <a href="{{ route('users') }}">
          <i class="now-ui-icons users_single-02"></i>
          <p>{{ __('User Management') }}</p>
        </a>
      </li>

    </ul>
  </div>

</div>
