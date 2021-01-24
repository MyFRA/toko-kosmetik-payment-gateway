<!DOCTYPE html>
<html>
<head>
  	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html charset=UTF-8" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Sofia&display=swap" rel="stylesheet">
    <style>
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            font-family: 'Open Sans', sans-serif;
        }
    </style>
</head>
<body style="padding: 1rem; background: #eee;">
    <div style="border-radius: 4px; background: #fff; box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.2)">
        <div style="background: #DB2777; text-align: center; border-top-left-radius: 4px; border-top-right-radius: 4px; padding: 1rem 0">
        	<i class="zmdi zmdi-email zmdi-hc-4x" style="color: #fff"></i>
        </div>
        <div style="background: #fff; text-align: center; padding: 1.5rem 2rem 3rem; border-bottom-left-radius: 4px; border-bottom-right-radius: 4px;">
            <h2 style="font-weight: 500; font-size: 30px;">Konfirmasi Email</h2>
            <p style="margin-top: 10px; color: #555; font-size: 15px">
                <span>Kami telah menerima pendaftaran akun kamu di </span>
                <a href="http://127.0.0.1:8000" style="text-decoration: none; color: #DB2777">Indah Jaya Kosmetik</a>
                <span>. Segera Konfirmasi E-mail kamu di sini.</span>
            </p>
            <form action="{{$link_verify_email}}" method="GET">
                <button type="submit" style="margin-top: 35px; font-size: 17px; font-weight: 600; border: none; padding: .75rem 4rem; background: #DB2777; color: #fff; border-radius: 3px">Verifikasi Email</button>
            </form>
        </div>
    </div>

    <h3 style="text-align: center; font-weight: 500; font-size: 20px; margin-top: 40px; font-family: 'Sofia', cursive;">Indah Jaya Kosmetik</h3>
</body>
</html>