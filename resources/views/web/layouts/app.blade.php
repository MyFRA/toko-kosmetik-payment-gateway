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
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/components.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/inline-class.css') }}">
    @yield('stylesheet')
    <title>{{ $title }} | Indah Jaya Kosmetik dan Aksesoris </title>
</head>
<body>

    <!-- Navbar -->
    @include('web.layouts.partials.navbar')
    <!-- End of Navbar -->

    <!-- Main Content -->
    <div id="app">
        @yield('content')
    </div>
    <!-- End of Main Content -->
    
    @if (!isset($remove_bottom_navigation))
        @include('web.layouts.partials.bottom-navigation')
    @endif

    <!-- Footer -->
    @include('web.layouts.partials.footer')
    <!-- Footer -->

    <!-- Form Logout -->
    <form action="{{ url('/logout') }}" method="POST" id="logout-action">
        @csrf
    </form>
    <!-- End of Form Logout -->
    
    <!-- Modal Select Category -->
    <div class="overlay" id="overlay"></div>
    <div class="modal" id="modal-select-category" style="position: fixed; top: 30%">
        <button class="modal-close-btn" id="close-btn"><i class="zmdi zmdi-close"></i></button>
        <h3>Pilih Kategori</h3>
        <select data-value="" id="select2-select-product-category" style="z-index: 999999; width: 100%">
        </select>
        <button id="ok">OK</button>
    </div>
    <!-- End of Modal Select Category -->

    <!-- Global Javascript Script -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        $(document).ready(function() {
            const url = '{{ url('/api/product-categories')}}';
            fetch(url).then(response => response.json())
                .then((res) => {
                    const product_categories                = res.data.product_categories;
                    const select2                           = document.getElementById('select2-select-product-category');
                    const old_selected_product_categories   = localStorage.getItem('old_product_category_search');
                    const button_select_product_category    = document.getElementById('button-select-product-category');
                    let options                             = `<option value="">Semua Kategori</option>`;
                    let text_to_navbar_select_category      = 'Semua Kategori';

                    product_categories.forEach((product_category) => {
                        if(product_category.slug == old_selected_product_categories) {
                            text_to_navbar_select_category = product_category.category_name;
                        }
                        const option = `<option value="${product_category.slug}" ${product_category.slug == old_selected_product_categories ? 'selected' : ''}>${product_category.category_name}</option>`;
                        options += option;
                    });
                    select2.innerHTML = options;
                    button_select_product_category.innerHTML = text_to_navbar_select_category;
                    $('#select2-select-product-category').select2();
                });
        });
    </script>
    <script>
        document.getElementById('button-select-product-category').addEventListener('click', function() {
            document.getElementById('overlay').classList.add('is-visible');
            document.getElementById('modal-select-category').classList.add('is-visible');
        });

        document.getElementById('close-btn').addEventListener('click', function() {
            document.getElementById('overlay').classList.remove('is-visible');
            document.getElementById('modal-select-category').classList.remove('is-visible');
        });
        
        document.getElementById('ok').addEventListener('click', function() {
            const select_tag_product_categories     = document.getElementById('select2-select-product-category');
            const selected_value                    = $('#select2-select-product-category').select2('data')[0];
            const button_select_product_category    = document.getElementById('button-select-product-category');

            button_select_product_category.innerHTML = selected_value.text;
            select_tag_product_categories.setAttribute('data-value', selected_value.id);

            document.getElementById('overlay').classList.remove('is-visible');
            document.getElementById('modal-select-category').classList.remove('is-visible');
        });
    </script>
    <script>
        function logoutAction()
        {
            event.preventDefault();
            document.getElementById('logout-action').submit();
        }
    </script>
    <script>
        const button_search_product     = document.getElementById('button-search-product');
        button_search_product.addEventListener('click', () => {
            const input_search_product_value    = document.getElementById('input-search-product').value;
            const product_category_search_value = document.getElementById('select2-select-product-category').getAttribute('data-value');
            const url = `{{url('/product')}}?category=${product_category_search_value}&product_name=${input_search_product_value}`;
            if(window) {
                localStorage.setItem('old_product_category_search', product_category_search_value);
            }
            window.location.href = url;
        });
    </script>
    <script>
        const logo_website = document.getElementById('logo-website');
        logo_website.addEventListener('click', () => {
            window.location.href = '{{url('/')}}';
        })  
    </script>
    <!-- End of Global Javascript Script -->

    <!-- Specify Files Javascript Script -->
    @yield('script')
    <!-- End of Specify Files Javascript Script -->
</body>
</html>