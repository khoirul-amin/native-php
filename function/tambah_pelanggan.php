<?php
include '../koneksi.php';
include '../library/database.php';
include '../library/info.php';

$nama = $_POST['nama'];
$nik = $_POST['NIK'];
$alamat = $_POST['alamat'];
$no_telp = $_POST['no_telp'];
$tgl_lahir = $_POST['lahir'];
$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];
$status = false;

if(!empty($_POST['id'])){
    $status = true;
    $pesan = "Update data berhasil";
    $id = $_POST['id'];
    $date = date('Y-m-d H:i:s');
    $query = "UPDATE users SET `username`='$username', `password`='$password', `email`='$email', `NIK`='$nik', `tgl_lahir`='$tgl_lahir', `nama`='$nama', `no_telp`='$no_telp', `alamat`='$alamat', `role`='3', `timestamps`='$date' WHERE id='$id'";
}else{
    if((new DB())->cek_user("SELECT * FROM users where username='$username'")){
        $pesan = "Username sudah terdaftar";
        $res = array(
            'status' => $status,
            'messages' => $pesan
        );
        $info = (new Info())->info_set($res);
        header('location:../user/pelanggan.php');
        die();
    }
    
    if((new DB())->cek_user("SELECT * FROM users where email='$email'")){
        $pesan = "Email sudah terdaftar";
        $res = array(
            'status' => $status,
            'messages' => $pesan
        );
        $info = (new Info())->info_set($res);
        header('location:../user/pelanggan.php');
        die();
    }
    if((new DB())->cek_user("SELECT * FROM users where no_telp='$no_telp'")){
        $pesan = "No. Telp sudah terdaftar";
        $res = array(
            'status' => $status,
            'messages' => $pesan
        );
        $info = (new Info())->info_set($res);
        header('location:../user/pelanggan.php');
        die();
    }
    if((new DB())->cek_user("SELECT * FROM users where nik='$nik'")){
        $pesan = "NIK sudah terdaftar";
        $res = array(
            'status' => $status,
            'messages' => $pesan
        );
        $info = (new Info())->info_set($res);
        header('location:../user/pelanggan.php');
        die();
    }
    
    $pesan = "Insert data berhasil";
    $status = true;
    $date = date('Y-m-d H:i:s');
    $query = "INSERT INTO users (`id`,`username`, `password`, `email`, `NIK`, `tgl_lahir`, `nama`, `no_telp`, `alamat`, `role`, `timestamps`) VALUES (null,'$username','$password','$email','$nik','$tgl_lahir','$nama','$no_telp','$alamat','3','$date')";
}

mysqli_query($koneksi,$query);

$res = array(
    'status' => $status,
    'messages' => $pesan
);
$info = (new Info())->info_set($res);
header('location:../user/pelanggan.php');
?>