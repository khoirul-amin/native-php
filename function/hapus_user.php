<?php
include '../koneksi.php';
include '../library/info.php';

$id_user = $_GET['id'];
$id_page = $_GET['halaman'];

mysqli_query($koneksi,"DELETE FROM users WHERE id=$id_user");

$res = array(
    'status' => true,
    'messages' => 'Data berhasil dihapus'
);
$info = (new Info())->info_set($res);
if($id_page == 'karyawan'){
    header('location:../user/karyawan.php');
}else{
    header('location:../user/pelanggan.php');
}
// echo 'success';
