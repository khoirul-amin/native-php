<?php
include '../koneksi.php';

$keterangan = $_POST['keterangan'];
$id_pemesanan = $_POST['id'];
$id_kategori = $_POST['kategori'];
$satuan = $_POST['satuan'];
$harga_satuan = $_POST['harga'];
$volume = $_POST['volume'];
$total = $volume*$harga_satuan;

$query = "INSERT INTO detail_konstruksi (`id`, `id_pemesanan`, `id_kategori`, `keterangan`, `satuan`, `harga_satuan`, `total`, `volume`) VALUES (null,'$id_pemesanan','$id_kategori','$keterangan','$satuan','$harga_satuan','$total','$volume')";

$result = mysqli_query($koneksi, $query);
header("location:../user/rab.php?id=$id_pemesanan");