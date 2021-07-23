<?php
include '../koneksi.php';
include '../library/info.php';


$status = false;
$nama =  $_POST['nama'];
$time = date('Y-m-d H:m:s');

if(!empty($_POST['id'])){
    $status = true;
    $pesan = "Update data berhasil";
    $id=$_POST['id'];
    $query = "UPDATE kategori SET nama_kategori='$nama',timestamp='$time' WHERE id=$id";
}else{
    $pesan = "Insert data berhasil";
    $status = true;
    $query = "INSERT INTO kategori (id,nama_kategori,timestamp) VALUES (null,'$nama','$time')";
}

mysqli_query($koneksi,$query);
$res = array(
    'status' => $status,
    'messages' => $pesan
);
$info = (new Info())->info_set($res);
header("location:../user/kategori.php");
?>