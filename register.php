<?php
    $style = 'style="background:#001970;"';
    include "./template/header.php";
    include './library/session.php';
    $session = (new Session())->cek_session();
    if($session){
        header('location:./user/index.php');
    }
?>


<div class="container mt-4 mb-4">
    <?php if($_GET['pesan'] == 'success'){ ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Register berhasil !</strong> Silahkan login elalui halaman login.
        <button type="button" class="close btn" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php } 
    else if($_GET['pesan'] == 'password'){ ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Register gagal !</strong> Password tidak sama.
        <button type="button" class="close btn" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php }
    else if(!empty($_GET['pesan']) && $_GET['pesan'] != 'success'){ ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Register gagal !</strong> Input <?=$_GET['pesan']?> yang anda masukkan sudah terdaftar.
        <button type="button" class="close btn" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php } ?>
    <div class="row justify-content-md-center pt-4 pb-4">
        <div class="col col-lg-8 p-0">
            <div class="row ml-0 mr-0 justify-content-center">
                <div class="col-md-4 d-none d-md-block text-center rounded-left" style="background:#001970;color:#9FA8DA;">
                    <p class="welcome mt-4">Welcome</p>
                    <span style="font-weight:bold;">Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum</span"><br>
                    <img src="../assets/img/brand/Register.svg" class="mt-4" style="width:150px;" alt="login-image"/><br/>

                    <a href="./login.php" class="rounded-pill btn btn-warning text-white mt-4 mb-4">Sign In</a>
                </div>
                <div class="col-md-6 rounded-right login-form text-center p-4">
                    <p class="login-title">Register</p>
                    <form action="./go_register.php" method="post" class="form-login1">
                        <input type="text" name="full-name" placeholder="Nama Lengkap" required/> <br/>
                        <input type="text" name="no-ktp" placeholder="No. KTP" required/> <br/>
                        <input type="text" name="alamat" placeholder="Alamat" required/> <br/>
                        <input type="text" name="no-hp" placeholder="No. HP" required/> <br/>
                        <input type="email" name="email" placeholder="Email" required/> <br/>
                        <input type="text" name="username" placeholder="Username" required/> <br/>
                        <input type="password" name="password" placeholder="Password" required/> <br/>
                        <input type="password" name="re-password" placeholder="Re-Password" required/> <br/>
                        <div class="row ml-0 mr-0 pr-4">
                            <div class="col-sm-12 text-right">
                                <button type="submit" class="rounded-pill text-white btn-login">Register</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    include "./template/footer.php";
?>