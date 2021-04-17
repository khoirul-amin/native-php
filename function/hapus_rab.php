<?php
include '../koneksi.php';


$id = $_GET['id'];
$id_pemesanan = $_GET['id_pem'];

mysqli_query($koneksi, "DELETE FROM detail_konstruksi WHERE id='$id'");

header("location:../user/rab.php?id=$id_pemesanan");