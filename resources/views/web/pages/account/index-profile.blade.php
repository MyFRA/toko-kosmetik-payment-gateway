@extends('web.layouts.app')

@section('content')
    <div class="account-index">
        <h3 class="font-weight-bold title padding-responsive text-666">{{ Auth::guard('customer')->user()->fullname }}</h3>
        @include('web.pages.account.components.index.account')
        {{-- @include('web.pages.account.components.index.daftar-transaksi') --}}
        <div class="padding-responsive">
            <a  class="account-page-logout-button" href="" onclick="logoutAction()">
                <h3><i class="zmdi zmdi-power mr-3"></i> Logout</h3>
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
        const Toast = Swal.mixin({
            toast: true,
            position: 'center',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
        })
    </script>
    <script>
        if(`{{session('success')}}` != `` ? true : false) {
            console.log('ok')
            Toast.fire({
                icon: 'success',
                title: `{{session('success')}}`,
            });
        } else if(`{{session('failed')}}` != `` ? true : false   ) {
            Toast.fire({
                icon: 'error',
                title: `{{session('failed')}}`,
            });
        }
    </script>
    <script>
        const product_image = document.querySelector('.account-profile .content-wrapper .profile-wrapper .photo-profile-wrapper form img');
        product_image.style.height = product_image.offsetWidth + 'px';
    </script>    
    <script>
        const buttonPilihFotoProfil     = document.querySelector('.account-profile .content-wrapper .profile-wrapper .photo-profile-wrapper form button');
        const inputFile                 = document.querySelector('.account-profile .content-wrapper .profile-wrapper .photo-profile-wrapper form input[type=file]');
        const buttonSubmit              = document.getElementById('submit-photo-button');
        const photoProfile              = document.getElementById('photo-profile');
        const formUpdatePhotoProfile    = document.querySelector('form#update-photo-profil');

        buttonPilihFotoProfil.addEventListener('click', () => {
            event.preventDefault();
            inputFile.click();
        });

        inputFile.addEventListener('change', () => {
            if( inputFile.files[0] != undefined ) {
                extension = inputFile.files[0].name.split('.')[inputFile.files[0].name.split('.').length - 1];
                validExtension = ['jpg', 'jpeg', 'png'];

                if(validExtension.includes(extension.toLowerCase())) {

                    buttonSubmit.classList.remove('d-none');
                    var reader = new FileReader();
                    reader.readAsDataURL(inputFile.files[0]);
                    reader.onload = function() {
                        photoProfile.setAttribute('src', reader.result);
                    }
                } else {
                    photoProfile.setAttribute('src', 'https://www.flaticon.com/svg/static/icons/svg/1602/1602467.svg');
                    ( !buttonSubmit.classList.contains('d-none') ) ? buttonSubmit.classList.add('d-none') : '';
                }
            } else {
                photoProfile.setAttribute('src', reader.result);
                ( !buttonSubmit.classList.contains('d-none') ) ? buttonSubmit.classList.add('d-none') : '';
            }
        });

        buttonSubmit.addEventListener('click', () => {
            formUpdatePhotoProfile.submit();
        });
    </script>

    <script>

        function displayInput(name, element)
        {
            event.preventDefault();
            const parent = element.parentElement;
            parent.text = '';

            if( name == 'birth' ) {
                parent.innerHTML = `<input type="date" name="${name}" value="{{ Auth::guard('customer')->user()->customerDetail->birth ? Auth::guard('customer')->user()->customerDetail->birth : '' }}" onchange="changeValueSubmit(this)" />`;
            } else if( name == 'gender' ) {
                parent.innerHTML = `
                    <select onchange="changeValueSubmit(this)" name="${name}">
                        <option value="laki-laki" {{ Auth::guard('customer')->user()->customerDetail->gender == 'laki-laki' ? 'selected' : '' }}>Laki laki</option>
                        <option value="perempuan" {{ Auth::guard('customer')->user()->customerDetail->gender == 'perempuan' ? 'selected' : '' }}>Perempuan</option> 
                    </select>`;
            } else if( name == 'fullname' ) {
                parent.innerHTML = `<input type="text" name="${name}" value="{{ Auth::guard('customer')->user()->fullname }}" onkeydown="changeValueSubmit(this)" autocomplete="off" />`;
            } else if( name == 'email') {
                parent.innerHTML = `<input type="email" name="${name}" value="{{ Auth::guard('customer')->user()->email }}" onkeydown="changeValueSubmit(this)" autocomplete="off" />`;
            } else if( name == 'number_phone') {
                parent.innerHTML = `<input type="number" name="${name}" value="{{ Auth::guard('customer')->user()->customerDetail->number_phone }}" onkeydown="changeValueSubmit(this)" autocomplete="off" />`;
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