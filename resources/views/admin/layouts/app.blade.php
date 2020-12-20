<!DOCTYPE html>
<html lang="en">
<head>
  @include('admin.layouts.partials.head')
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
            <h2 class="section-title">Form Validation</h2>
            @yield('content')
          </div>
        </section>
      </div>
      
      @include('admin.layouts.partials.footer')

    </div>
  </div>

  @include('admin.layouts.partials.script')
</body>
</html>
