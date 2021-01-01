<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@100;300;400;700;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/components.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/inline-class.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    @yield('stylesheet')
    <title>{{ $title || '' }} | Toko Kosmetik</title>
</head>
<body>
        
    @include('web.layouts.partials.navbar')

    <div id="app">
        @yield('content')
    </div>
    
    @if (!isset($remove_bottom_navigation))
    @include('web.layouts.partials.bottom-navigation')
    @endif
    @include('web.layouts.partials.footer')
    <form action="{{ url('/logout') }}" method="POST" id="logout-action">
        @csrf
    </form>
    @include('web.layouts.partials.script')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            const url = '{{ url('/api/product-categories')}}';
            fetch(url).then(response => response.json())
                .then((res) => {
                    const product_categories = res.data.product_categories;
                    const product_category_search_wrap = document.getElementById('select-product-category-wrap');
                    const product_category_search = document.createElement('select');
                    product_category_search.setAttribute('name', 'product_category_id');
                    product_category_search.setAttribute('id', 'navbar-select-category');
    
                    let options = '<option value="">Semua Kategori</option>';
                    const old_selected_category = localStorage.getItem('old_product_category_search') || null;
                    
                    product_categories.forEach((e) => {
                        const option = `<option value="${e.slug}" ${old_selected_category == e.slug ? 'selected' : ''}>${e.category_name}</option>`;
                        options += option;
                    });
                    product_category_search.innerHTML = options;
                    product_category_search_wrap.appendChild(product_category_search);
                    $('#navbar-select-category').select2();
                });
        });
    </script>
    @yield('script')
</body>
</html>