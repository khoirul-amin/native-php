<?php
include '../koneksi.php';
$id_user = $_GET['id'];

mysqli_query($koneksi,"DELETE FROM kategori WHERE id=$id_user");
echo 'success';
