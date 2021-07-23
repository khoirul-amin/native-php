<?php
include '../koneksi.php';
include '../library/info.php';

$status = false;
$id_kategori =  $_POST['kategori'];
$keterangan =  $_POST['keterangan'];
$satuan =  $_POST['satuan'];
$harga =  $_POST['harga'];
$time = date('Y-m-d H:m:s');


if(!empty($_POST['id'])){
    $status = true;
    $pesan = "Update data berhasil";
    $id=$_POST['id'];
    $query = "UPDATE keterangan SET id_kategori='$id_kategori', keterangan='$keterangan', satuan='$satuan', harga='$harga', timestamp='$time' WHERE id=$id";
}else{
    $pesan = "Insert data berhasil";
    $status = true;
    $query = "INSERT INTO keterangan (id,id_kategori,keterangan,satuan,harga,timestamp) VALUES (null,'$id_kategori','$keterangan','$satuan','$harga','$time')";
}

mysqli_query($koneksi,$query);
$res = array(
    'status' => $status,
    'messages' => $pesan
);
$info = (new Info())->info_set($res);
header("location:../user/keterangan.php");
?>