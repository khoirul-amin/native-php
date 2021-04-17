<?php
include '../koneksi.php';
include '../library/session.php';
$session = (new Session())->cek_session();

$id = $_POST['id'];
$proses = $_POST['proses'];
$keterangan = $_POST['keterangan'];
$admin = $session->id;

$query = "UPDATE pemesanan SET status='$proses',ket_ditolak='$keterangan',admin_id='$admin' WHERE id='$id'";

mysqli_query($koneksi,$query);
header('location:../user/proyek.php');
?>