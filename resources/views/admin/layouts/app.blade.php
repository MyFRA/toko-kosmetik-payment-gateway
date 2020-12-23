<!DOCTYPE html>
<html lang="en">
<head>
  @include('admin.layouts.partials.head')
  @yield('stylesheet')
</head>

<body>
  <div id="app">
    <div class="main-wrapper">
      <div class="navbar-bg"></div>
      @include('admin.layouts.partials.navbar')
      @include('admin.layouts.partials.sidebar')

      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          @include('admin.layouts.partials.section-header')
          <div class="section-body">
            @yield('content')
          </div>
        </section>
      </div>
      
      @include('admin.layouts.partials.footer')

    </div>
  </div>

  @include('admin.layouts.partials.script')
  @yield('script')
</body>
</html>
