<div class="main-sidebar">
    <aside id="sidebar-wrapper">
      <div class="sidebar-brand">
        <a href="index.html">Stisla</a>
      </div>
      <div class="sidebar-brand sidebar-brand-sm">
        <a href="index.html">St</a>
      </div>
      <ul class="sidebar-menu">
          <li class="menu-header">Dashboard</li>
          <li class="{{ $sidebar == 'dashboard' ? 'active' : '' }}"><a class="nav-link" href="{{ url('/app-admin') }}"><i class="fas fa-home"></i> <span>Dashboard</span></a></li>
          <li class="menu-header">Produk</li>
          <li class="{{ $sidebar == 'product' ? 'active' : '' }}"><a class="nav-link" href="{{ url('/app-admin/product') }}"><i class="fas fa-shopping-bag"></i> <span>Produk</span></a></li>
          <li class="{{ $sidebar == 'product-category' ? 'active' : '' }}"><a class="nav-link" href="{{ url('/app-admin/product-category') }}"><i class="fas fa-list-alt"></i> <span>Kategori Produk</span></a></li>
          <li class="{{ $sidebar == 'promo' ? 'active' : '' }}"><a class="nav-link" href="{{ url('/app-admin/promo') }}"><i class="fas fa-tags"></i> <span>Promo</span></a></li>
          <li class="{{ $sidebar == 'discount' ? 'active' : '' }}"><a class="nav-link" href="{{ url('/app-admin/discount') }}"><i class="fas fa-percent"></i> <span>Diskon</span></a></li>
          <li class="menu-header">Akun</li>
          <li class="{{ $sidebar == 'profile' ? 'active' : '' }}">
            <a class="nav-link" href="{{ url('/app-admin/profile') }}"><i class="far fa-user"></i> <span>Profil</span></a>
          </li>
          <li class="{{ $sidebar == 'bank-account' ? 'active' : '' }}">
            <a class="nav-link" href="{{ url('/app-admin/bank-account') }}"><i class="far fa-credit-card"></i> <span>Rekening Bank</span></a>
          </li>
          <li class="menu-header">Lainya</li>
          <li class="{{ $sidebar == 'faq' ? 'active' : '' }}">
            <a class="nav-link" href="{{ url('/app-admin/faq') }}"><i class="far fa-comments"></i> <span>FAQ</span></a>
          </li>
          <li class="nav-item dropdown">
            <a href="#" class="nav-link has-dropdown"><i class="fas fa-th-large"></i> <span>Components</span></a>
            <ul class="dropdown-menu">
              <li><a class="nav-link" href="components-article.html">Article</a></li>
              <li><a class="nav-link beep beep-sidebar" href="components-avatar.html">Avatar</a></li>
              <li><a class="nav-link" href="components-chat-box.html">Chat Box</a></li>
              <li><a class="nav-link beep beep-sidebar" href="components-empty-state.html">Empty State</a></li>
              <li><a class="nav-link" href="components-gallery.html">Gallery</a></li>
              <li><a class="nav-link beep beep-sidebar" href="components-hero.html">Hero</a></li>
              <li><a class="nav-link" href="components-multiple-upload.html">Multiple Upload</a></li>
              <li><a class="nav-link beep beep-sidebar" href="components-pricing.html">Pricing</a></li>
              <li><a class="nav-link" href="components-statistic.html">Statistic</a></li>
              <li><a class="nav-link" href="components-tab.html">Tab</a></li>
              <li><a class="nav-link" href="components-table.html">Table</a></li>
              <li><a class="nav-link" href="components-user.html">User</a></li>
              <li><a class="nav-link beep beep-sidebar" href="components-wizard.html">Wizard</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a href="#" class="nav-link has-dropdown"><i class="far fa-file-alt"></i> <span>Forms</span></a>
            <ul class="dropdown-menu">
              <li><a class="nav-link" href="forms-advanced-form.html">Advanced Form</a></li>
              <li><a class="nav-link" href="forms-editor.html">Editor</a></li>
              <li><a class="nav-link" href="forms-validation.html">Validation</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a href="#" class="nav-link has-dropdown"><i class="fas fa-map-marker-alt"></i> <span>Google Maps</span></a>
            <ul class="dropdown-menu">
              <li><a href="gmaps-advanced-route.html">Advanced Route</a></li>
              <li><a href="gmaps-draggable-marker.html">Draggable Marker</a></li>
              <li><a href="gmaps-geocoding.html">Geocoding</a></li>
              <li><a href="gmaps-geolocation.html">Geolocation</a></li>
              <li><a href="gmaps-marker.html">Marker</a></li>
              <li><a href="gmaps-multiple-marker.html">Multiple Marker</a></li>
              <li><a href="gmaps-route.html">Route</a></li>
              <li><a href="gmaps-simple.html">Simple</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a href="#" class="nav-link has-dropdown"><i class="fas fa-plug"></i> <span>Modules</span></a>
            <ul class="dropdown-menu">
              <li><a class="nav-link" href="modules-calendar.html">Calendar</a></li>
              <li><a class="nav-link" href="modules-chartjs.html">ChartJS</a></li>
              <li><a class="nav-link" href="modules-datatables.html">DataTables</a></li>
              <li><a class="nav-link" href="modules-flag.html">Flag</a></li>
              <li><a class="nav-link" href="modules-font-awesome.html">Font Awesome</a></li>
              <li><a class="nav-link" href="modules-ion-icons.html">Ion Icons</a></li>
              <li><a class="nav-link" href="modules-owl-carousel.html">Owl Carousel</a></li>
              <li><a class="nav-link" href="modules-sparkline.html">Sparkline</a></li>
              <li><a class="nav-link" href="modules-sweet-alert.html">Sweet Alert</a></li>
              <li><a class="nav-link" href="modules-toastr.html">Toastr</a></li>
              <li><a class="nav-link" href="modules-vector-map.html">Vector Map</a></li>
              <li><a class="nav-link" href="modules-weather-icon.html">Weather Icon</a></li>
            </ul>
          </li>
          <li class="menu-header">Pages</li>
          <li class="nav-item dropdown">
            <a href="#" class="nav-link has-dropdown"><i class="far fa-user"></i> <span>Auth</span></a>
            <ul class="dropdown-menu">
              <li><a href="auth-forgot-password.html">Forgot Password</a></li>
              <li><a href="auth-login.html">Login</a></li>
              <li><a class="beep beep-sidebar" href="auth-login-2.html">Login 2</a></li>
              <li><a href="auth-register.html">Register</a></li>
              <li><a href="auth-reset-password.html">Reset Password</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a href="#" class="nav-link has-dropdown"><i class="fas fa-exclamation"></i> <span>Errors</span></a>
            <ul class="dropdown-menu">
              <li><a class="nav-link" href="errors-503.html">503</a></li>
              <li><a class="nav-link" href="errors-403.html">403</a></li>
              <li><a class="nav-link" href="errors-404.html">404</a></li>
              <li><a class="nav-link" href="errors-500.html">500</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a href="#" class="nav-link has-dropdown"><i class="fas fa-bicycle"></i> <span>Features</span></a>
            <ul class="dropdown-menu">
              <li><a class="nav-link" href="features-activities.html">Activities</a></li>
              <li><a class="nav-link" href="features-post-create.html">Post Create</a></li>
              <li><a class="nav-link" href="features-posts.html">Posts</a></li>
              <li><a class="nav-link" href="features-profile.html">Profile</a></li>
              <li><a class="nav-link" href="features-settings.html">Settings</a></li>
              <li><a class="nav-link" href="features-setting-detail.html">Setting Detail</a></li>
              <li><a class="nav-link" href="features-tickets.html">Tickets</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a href="#" class="nav-link has-dropdown"><i class="fas fa-ellipsis-h"></i> <span>Utilities</span></a>
            <ul class="dropdown-menu">
              <li><a href="utilities-contact.html">Contact</a></li>
              <li><a class="nav-link" href="utilities-invoice.html">Invoice</a></li>
              <li><a href="utilities-subscribe.html">Subscribe</a></li>
            </ul>
          </li>
          <li><a class="nav-link" href="credits.html"><i class="fas fa-pencil-ruler"></i> <span>Credits</span></a></li>
        </ul>

        <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
          <a href="https://getstisla.com/docs" class="btn btn-primary btn-lg btn-block btn-icon-split">
            <i class="fas fa-rocket"></i> Documentation
          </a>
        </div>
    </aside>
  </div>