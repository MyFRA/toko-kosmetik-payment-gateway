<style>
    * {
        padding: 0;
        margin: 0;
        box-sizing: border-box;
        font-family: 'Poppins', sans-serif;
    }

    .container {
        width: 100%;
        padding: 1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #eee;
    }

    .email-wrapper-box {
        background: #fff;
        padding: 1.5rem;
        box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.03);
        border-radius: 5px;
        display: flex;
        flex-direction: column;
    }

    .email-wrapper-box img {
        width: 80px;
    }

    .email-wrapper-box h2 {
        color: #333;
        margin-top: 1rem;
    }

    .email-wrapper-box p {
        color: #777;
        font-size: 14px;
        margin-top: 17px;
    }

    .email-wrapper-box p a {
        color: #DB2777;
        text-decoration: none;
    }

    .email-wrapper-box a.button-verification {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #DB2777;
        color: #fff;
        font-weight: 700;
        font-size: 18px;
        text-decoration: none;
        padding: .8rem 0;
        margin-top: 1rem;
        border-radius: 4px;
        transition: all 150ms ease;
    }

    .email-wrapper-box a.button-verification:hover {
        background: #ce0962;
    }

    .email-wrapper-box span {
        color: #666;
        font-size: 14px;
        margin-top: 4rem;
    }

    .email-wrapper-box span a {
        color: #DB2777;
        text-decoration: none;
    }

    .email-wrapper-box span a:hover {
        text-decoration: underline;
    }
</style>
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
<div class="container">
<div class="email-wrapper-box">
    <img src="http://kosmetik.smkn1rembang-pbg.sch.id/images/icons/logo.png" alt="">
    <h2>Verifikasi Akun</h2>
    <p>Kami telah menerima pendaftaran akun kamu di <a href="{{ url('/') }}">Indah Jaya Kosmetik</a>. Segera Konfirmasi E-mail kamu di sini.</p>
    <a href="" class="button-verification">Verifikasi Email</a>
    <span>Butuh pertanyaan atau bantuan email kami di <a href="mailto:official.indah-jaya@gmail.com">official.indahjaya@gmail.com</a></span>
</div>
</div>

