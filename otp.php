<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
    <meta name="author" content="Creative Tim">
    <title>Jasa Konstruksi Bangunan</title>
    <!-- Bootstrap CSS -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./assets/css/bootstrap/bootstrap.css" type="text/css">
    <link rel="stylesheet" href="./assets/css/custom-landing.css" type="text/css">
    <link rel="stylesheet" href="./assets/vendor/sweetalert2/dist/sweetalert2.min.css">
    <link rel="icon" href="./assets/img/brand/favicon.png" type="image/png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
    <link rel="stylesheet" href="./assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
  <style type="text/css">
        html, body {
            height: 100%;
            margin: 0;
            background:white;
        }    
        #wrapper {
            min-height: 100%; 
            background: #E7E9F8 0% 0% no-repeat padding-box;
            opacity: 1;
        }
        .otp{
            background: #FFFFFF 0% 0% no-repeat padding-box;
            box-shadow: 0px 3px 20px #00000029;
            border-radius: 10px;
            opacity: 1;
        }
        .form-otp input{
            outline:none;
            border-top:none;
            border-left:none;
            border-right:none;
            border-bottom:2px solid black;
            height:40px;
            width:40px;
        }

  </style>
</head>
<body>
    <div id="wrapper" class="row align-items-center justify-content-center ml-0 mr-0">
            <div class="col-lg-4 otp text-center pt-4 pb-4">
            <p style="color:#9FA8DA;opacity:1;"><b>Masukkan kode yang sudah di kirim melalui email</b></p>
            <p style="color:#001970;"><b>Silahkan Masukkan OTP</b></p>
            <p style="color:#FEBD00;"><b>1 : 52</b></p>
            <form action="" class="form-otp">
                <input type="text" />
                <input type="text" />
                <input type="text" />
                <input type="text" />

                <div class="col-sm-12 mt-3">
                <button type="button" class="btn btn-sm btn-outline-primary rounded-pill">Resend OTP</button>
                <button type="button" class="btn btn-sm btn-primary rounded-pill">Verify OTP</button>
                </div>
            </form>
            </div>
    </div>
</body>

<script src="./assets/vendor/jquery/dist/jquery.min.js"></script>
<script src="./assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="./assets/vendor/sweetalert2/dist/sweetalert2.min.js"></script>
</html>