<div class="account-profile">
    <div class="link-wrapper">
        <a href="" class="active">Biodata Diri</a>
        <a href="">Daftar Alamat</a>
    </div>
    <div class="content-wrapper">
        <div class="px-15 py-20">
            <div class="profile-wrapper">
                <div class="photo-profile-wrapper">
                    <form>
                        <img src="https://ecs7.tokopedia.net/img/cache/300/default_picture_user/default_toped-18.jpg" alt="photo-profil">
                        <button>Pilih Foto</button>
                        <input type="file">
                        <div class="desc">
                            <p>Besar file: maksimum (10 Megabytes)</p>
                            <p>Ekstensi file : .JPG .JPEG .PNG</p>
                        </div>
                        <a href=""><i class="zmdi zmdi-key"></i> Ubah Kata Sandi</a>
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