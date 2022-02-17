<div class="sidebar" data-color="green" data-background-color="white" data-image="{{ asset('material') }}/img/sidebar-1.jpg">
  <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
  -->
  <div class="logo" style="background-color: currentColor;">
    <a href="/login" class="simple-text logo-normal">
    <img src="{{ asset('material') }}/img/logo-footer.png" alt="logo" style="width: 50%"/>
    </a>
  </div>
  <div class="sidebar-wrapper" style="background-color: currentColor;">
    <ul class="nav">
      <li class="nav-item{{ $activePage == 'main' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('home') }}">
            <i class="material-icons">home</i>
            <p>{{ __('Main') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'search' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('search') }}">
          <i class="material-icons">search</i>
            <p>{{ __('Search') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'manage_documents' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('manage.index') }}">
          <i class="material-icons">description</i>
            <p>{{ __('Master Data') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'create_users' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('create_users.index') }}">
          <i class="material-icons">person_add</i>
            <p>{{ __('Create Member') }}</p>
        </a>
      </li>
      @if(Auth::user()->role == 1)
      <li class="nav-item{{ $activePage == 'manage_users' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('manage_users.index') }}">
          <i class="material-icons">manage_accounts</i>
            <p>{{ __('Manage User') }}</p>
        </a>
      </li>
      @endif
    </ul>
  </div>
</div>
