<?php 
// mengaktifkan session pada php
session_start();
 
// menghubungkan php dengan koneksi database
include './koneksi.php';
 
// menangkap data yang dikirim dari form login
$username = $_POST['username'];
$password = $_POST['password'];
 
 
// menyeleksi data user dengan username dan password yang sesuai
$login = mysqli_query($koneksi,"select * from users where username='$username' and password='$password'");
// menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($login);

if($cek == 0 ){
    header("location:./login.php?pesan=gagal");
    die();
}

$data = mysqli_fetch_assoc($login);
$data = (object) $data;
$_SESSION['userLogin'] = $data;
header("location:./user/index.php");
die();