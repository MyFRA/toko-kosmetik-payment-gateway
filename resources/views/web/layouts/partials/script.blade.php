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
        const input_search_product_value = document.getElementById('input-search-product').value;
        const product_category_search_value = document.getElementById('navbar-select-category').value;
        const url = `{{url('/product')}}?category=${product_category_search_value}&product_name=${input_search_product_value}`;

        if(window) {
            localStorage.setItem('old_product_category_search', product_category_search_value);
        }
        window.location.href = url;
    });
</script>