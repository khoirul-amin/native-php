<?php
include '../koneksi.php';
include '../library/database.php';

$nama = $_POST['nama'];
$nik = $_POST['NIK'];
$alamat = $_POST['alamat'];
$no_telp = $_POST['no_telp'];
$tgl_lahir = $_POST['lahir'];
$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];

if(!empty($_POST['id'])){
    $id = $_POST['id'];
    $date = date('Y-m-d H:i:s');
    $query = "UPDATE users SET `username`='$username', `password`='$password', `email`='$email', `NIK`='$nik', `tgl_lahir`='$tgl_lahir', `nama`='$nama', `no_telp`='$no_telp', `alamat`='$alamat', `role`='3', `timestamps`='$date' WHERE id='$id'";
}else{
    if((new DB())->cek_user("SELECT * FROM users where username='$username'")){
        header('location:../user/pelanggan.php?pesan=username');
        die();
    }
    
    if((new DB())->cek_user("SELECT * FROM users where email='$email'")){
        header('location:../user/pelanggan.php?pesan=email');
        die();
    }
    if((new DB())->cek_user("SELECT * FROM users where no_telp='$no_telp'")){
        header('location:../user/pelanggan.php?pesan=telp');
        die();
    }
    if((new DB())->cek_user("SELECT * FROM users where nik='$nik'")){
        header('location:../user/pelanggan.php?pesan=nik');
        die();
    }
    
    $date = date('Y-m-d H:i:s');
    $query = "INSERT INTO users (`id`,`username`, `password`, `email`, `NIK`, `tgl_lahir`, `nama`, `no_telp`, `alamat`, `role`, `timestamps`) VALUES (null,'$username','$password','$email','$nik','$tgl_lahir','$nama','$no_telp','$alamat','3','$date')";
}

mysqli_query($koneksi,$query);
header('location:../user/pelanggan.php');
?>