<?php

include '../koneksi.php';
include '../library/info.php';
include '../library/session.php';
$session = (new Session())->cek_session();



$id = $session->id;
$nama = $_POST['nama'];
$tgl_lahir = $_POST['tgl_lahir'];
$alamat = $_POST['alamat'];
$password = $_POST['password'];

$query = "UPDATE users SET nama='$nama',alamat='$alamat',tgl_lahir='$tgl_lahir',password='$password' WHERE id='$id'";
mysqli_query($koneksi,$query);
// header('location:../user/setting.php');

$res = array(
    'status' => true,
    'messages' => "Data Berhasil Dirubah"
);
(new Info())->info_set($res);

echo json_encode($res);