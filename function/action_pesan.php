<?php

include '../koneksi.php';
include '../library/session.php';
$session = (new Session())->cek_session();

$maxs =  mysqli_query($koneksi,"SELECT MAX(id) as id FROM pemesanan");
$invoice = "";
while($max = mysqli_fetch_array($maxs)){
    $invoice = 'B00'.($max['id']+1);
}

$id_user = $session->id;
$ukuran = $_POST['ukuran'];
$lantai = $_POST['lantai'];
$luas_bangunan = $_POST['luas_bangunan'];
$id_model = $_POST['model'];
$kamar = $_POST['kamar'];
$kamar_mandi = $_POST['kamar_mandi'];
$garasi = $_POST['garasi'];
$referensi = $_POST['referensi'];
$pesan = $_POST['pesan'];
$tanggal = date('Y-m-d H:i:s');

$res = mysqli_query($koneksi, "INSERT INTO pemesanan (`id`, `user_id`, `admin_id`, `invoice`, `ukuran`, `lantai`, `luas_bangunan`, `id_model`, `kamar`, `kamar_mandi`, `garasi`, `referensi`, `pesan`, `tanggal`, `status`, `bukti_pembayaran`, `desain_rumah`, `ket_ditolak`) VALUES (null, '$id_user',null,'$invoice','$ukuran','$lantai','$luas_bangunan','$id_model','$kamar','$kamar_mandi','$garasi','$referensi','$pesan','$tanggal',1,null,null,null)");

if ( false===$res ) {
printf("error: %s\n", mysqli_error($koneksi));
}
header('location:../pesanan.php');