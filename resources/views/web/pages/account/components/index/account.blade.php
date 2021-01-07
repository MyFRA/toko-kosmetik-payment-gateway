<div class="account-profile">
    <div class="link-wrapper">
        <a href="{{ url('/account') }}" class="active">Biodata Diri</a>
        <a href="{{ url('/account/address') }}">Daftar Alamat</a>
    </div>
    <div class="content-wrapper">
        <div class="px-15 py-20">
            <div class="profile-wrapper">
                <div class="photo-profile-wrapper">
                    <form method="POST" action="{{ url('/account/photo/update') }}" id="update-photo-profil" enctype="multipart/form-data">
                        @csrf
                        <img src="{{ is_null(Auth::guard('customer')->user()->photo) ? 'https://i.pinimg.com/736x/4d/b8/3d/4db83d1b757657acf5edc8bd66e50abf.jpg' : asset('/storage/images/customer-profiles/' . Auth::guard('customer')->user()->photo) }}" alt="photo-profile" id="photo-profile">
                        <button><i class="zmdi zmdi-image mr-3"></i> Pilih Foto</button>
                        <button class="bg-success text-white border-0 mb-4 d-none" id="submit-photo-button">Simpan</button>
                        <input type="file" id="photo" name="photo">
                        <div class="desc">
                            <p>Besar file: maksimum (10 Megabytes)</p>
                            <p>Ekstensi file : .JPG .JPEG .PNG</p>
                        </div>
                        <a href="{{ url('/account/change-password') }}"><i class="zmdi zmdi-key mr-3"></i> Ubah Kata Sandi</a>
                    </form>
                </div>
                <div class="explain-wrapper">
                    <div class="data-group">
                        <h5>Biodata Diri</h5>
                        <div class="row-group">
                            <p class="label">Nama</p>
                            <p class="value">{{ Auth::guard('customer')->user()->fullname }} <a href="" onclick="displayInput('fullname', this)">Edit</a></p>
                        </div>
                        <div class="row-group">
                            <p class="label">Tanggal Lahir</p>
                            <p class="value">{{ Auth::guard('customer')->user()->customerDetail->birth ? Auth::guard('customer')->user()->customerDetail->birth : '-' }} <a href="" onclick="displayInput('birth', this)">Edit</a></p>
                        </div>
                        <div class="row-group">
                            <p class="label">Jenis Kelamin</p>
                            <p class="value">{{ Auth::guard('customer')->user()->customerDetail->gender ? Auth::guard('customer')->user()->customerDetail->gender : '-' }} <a href="" onclick="displayInput('gender', this)">Edit</a></p>
                        </div>
                    </div>
                    <div class="data-group mt-20">
                        <h5>Kontak</h5>
                        <div class="row-group">
                            <p class="label">Email</p>
                            <p class="value">{{ Auth::guard('customer')->user()->email }} <a href="" onclick="displayInput('email', this)">Edit</a></p>
                        </div>
                        <div class="row-group">
                            <p class="label">Nomor HP</p>
                            <p class="value">{{ Auth::guard('customer')->user()->customerDetail->number_phone ? Auth::guard('customer')->user()->customerDetail->number_phone : '-' }} <a href="" onclick="displayInput('number_phone', this)">Edit</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>