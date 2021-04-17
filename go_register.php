<?php

include './library/database.php';
include './koneksi.php';

$nama = $_POST['full-name'];
$nik = $_POST['no-ktp'];
$alamat = $_POST['alamat'];
$no_telp = $_POST['no-hp'];
$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];
$re_password = $_POST['re-password'];


if(empty($nama) || empty($nik) || empty($alamat) || empty($no_telp) || empty($email) || empty($username) || empty($password) || empty($re_password)){
    header('location:./register.php?pesan=kosong');
    die();
}
if((new DB())->cek_user("SELECT * FROM users where username='$username'")){
    header('location:./register.php?pesan=username');
    die();
}

if((new DB())->cek_user("SELECT * FROM users where email='$email'")){
    header('location:./register.php?pesan=email');
    die();
}
if((new DB())->cek_user("SELECT * FROM users where no_telp='$no_telp'")){
    header('location:./register.php?pesan=telp');
    die();
}
if((new DB())->cek_user("SELECT * FROM users where nik='$nik'")){
    header('location:./register.php?pesan=nik');
    die();
}

if($password != $re_password){
    header('location:./register.php?pesan=password');
}else{
    $date = date('Y-m-d H:i:s');
    $query = "INSERT INTO users (`id`,`username`, `password`, `email`, `NIK`, `tgl_lahir`, `nama`, `no_telp`, `alamat`, `role`, `timestamps`) VALUES (null,'$username','$password','$email','$nik',null,'$nama','$no_telp','$alamat','3','$date')";
    mysqli_query($koneksi,$query);
    header('location:./register.php?pesan=success');
}