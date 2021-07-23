<?php
include '../koneksi.php';
include '../library/info.php';

$id_user = $_GET['id'];

mysqli_query($koneksi,"DELETE FROM kategori WHERE id=$id_user");
$res = array(
    'status' => true,
    'messages' => 'Data berhasil dihapus'
);
$info = (new Info())->info_set($res);
header('location:../user/kategori.php');
// echo 'success';
