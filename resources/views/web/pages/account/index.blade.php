@extends('web.layouts.app')

@section('content')
    <div class="account-index">
        <h3 class="font-weight-bold title padding-responsive text-666">Muhammad Tomy</h3>
        @include('web.pages.account.components.index.account')
        @include('web.pages.account.components.index.daftar-transaksi')
        @include('web.pages.account.components.index.faq')
        @include('web.pages.account.components.index.hubungi-kami')
        <div class="padding-responsive">
            <a href="" onclick="logoutAction()">
                <h3 class="title-account-daftar-transaksi">Logout</h3>
            </a>
        </div>
        @include('web.pages.account.components.index.product-recommendation')

        <form action="" method="POST" id="form-update">
            @csrf
        </form>
    </div>
@endsection


@section('script')
    <script>
        const product_image = document.querySelector('.account-profile .content-wrapper .profile-wrapper .photo-profile-wrapper form img');
        product_image.style.height = product_image.offsetWidth + 'px';
    </script>    
    <script>
        const buttonPilihFotoProfil = document.querySelector('.account-profile .content-wrapper .profile-wrapper .photo-profile-wrapper form button');
        const inputFile = document.querySelector('.account-profile .content-wrapper .profile-wrapper .photo-profile-wrapper form input');
    
        buttonPilihFotoProfil.addEventListener('click', () => {
            inputFile.click();
        });
    </script>

    <script>

        function displayInput(name, element)
        {
            event.preventDefault();
            const parent = element.parentElement;
            parent.text = '';

            if( name == 'birth' ) {
                parent.innerHTML = `<input type="date" name="${name}" value="{{ Auth::guard('customer')->user()->customerDetail->birth }}" onchange="changeValueSubmit(this)" />`;
            } else if( name == 'gender' ) {
                parent.innerHTML = `
                    <select onchange="changeValueSubmit(this)" name="${name}">
                        <option value="laki-laki">Laki laki</option>
                        <option value="perempuan">Perempuan</option> 
                    </select>`;
            } else if( name == 'fullname' ) {
                parent.innerHTML = `<input type="text" name="${name}" value="{{ Auth::guard('customer')->user()->fullname }}" onkeydown="changeValueSubmit(this)" />`;
            } else if( name == 'email') {
                parent.innerHTML = `<input type="email" name="${name}" value="{{ Auth::guard('customer')->user()->email }}" onkeydown="changeValueSubmit(this)" />`;
            } else if( name == 'number_phone') {
                parent.innerHTML = `<input type="number" name="${name}" value="{{ Auth::guard('customer')->user()->customerDetail->number_phone }}" onkeydown="changeValueSubmit(this)" />`;
            }

            // Adding Button
            parent.innerHTML += `<button data-url="{{ url('/account') }}/${name}/update"> simpan`;

            let input = !parent.querySelector('input') ? parent.querySelector('select') : parent.querySelector('input');
            let button = parent.querySelector('button');

            button.setAttribute('onclick', `submitValue(this, '${name}', '${input.value}')`);
        }

        function submitValue(element, name, value)
        {
            const url = element.getAttribute('data-url');
            const form = document.getElementById('form-update');

            form.setAttribute('action', url);
            form.innerHTML += `<input name="${name}" value="${value}" />`;
            form.submit();
        }

        function changeValueSubmit(element)
        {
            let value = element.value;
            let name  = element.getAttribute('name');
            let elementWantToChanged = element.nextElementSibling;

            elementWantToChanged.setAttribute('onclick', `submitValue(this, '${name}', '${value}')`);
        }
    </script>
@endsection