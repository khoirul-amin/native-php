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
    <?php
    if(!empty($_GET['pesan'])){
    if($_GET['pesan'] == 'gagal'){ ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Login Gagal !</strong> Cek kembali username atau password anda.
        <button type="button" class="close btn" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php } } ?>
    <div class="row justify-content-md-center pt-4 pb-4">
        <div class="col col-lg-8 p-0">
            <div class="row ml-0 mr-0 justify-content-center">
                <div class="col-md-4 d-none d-md-block text-center rounded-left" style="background:#001970;color:#9FA8DA;">
                    <p class="welcome mt-4">Welcome</p>
                    <span style="font-weight:bold;">Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum</span"><br>
                    <img src="./assets/img/brand/Login.svg" class="mt-4" style="width:150px;" alt="login-image"/><br/>

                    <a href="./register.php" class="rounded-pill btn btn-warning text-white mt-4 mb-4">Sign Up</a>
                </div>
                <div class="col-md-6 rounded-right login-form text-center p-4">
                    <p class="login-title">Login</p>
                    <form action="./cek_login.php" method="post" class="form-login">
                        <input type="text" name="username" placeholder="Username"/> <br/>
                        <input type="Password" name="password" placeholder="Password"/> <br/>
                        <div class="row ml-0 mr-0 p-3">
                            <div class="col pt-2">
                                <a class="forgot" href="#">Forgrt Password?</a>
                            </div>
                            <div class="col text-right">
                                <button type="submit" class="rounded-pill text-white btn-login">Login</button>
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
