<?php
include '../koneksi.php';
$nama =  $_POST['nama'];
$time = date('Y-m-d H:m:s');
if(!empty($_POST['id'])){
    $id=$_POST['id'];
    $query = "UPDATE kategori SET nama_kategori='$nama',timestamp='$time' WHERE id=$id";
}else{
    $query = "INSERT INTO kategori (id,nama_kategori,timestamp) VALUES (null,'$nama','$time')";
}

mysqli_query($koneksi,$query);
header("location:../user/kategori.php");
?>